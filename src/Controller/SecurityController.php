<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ResettingType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }

    /**
     * @Route("/reset", name="reset_password")
     */
    public function requestReset(
        Request $request,
        \Swift_Mailer $mailer,
        TokenGeneratorInterface $tokenGenerator,
        UserRepository $repo
    ) {
        // création d'un formulaire "à la volée", afin que l'internaute puisse renseigner son mail
        $form = $this->createFormBuilder()
            ->add('email', EmailType::class, [
                'constraints' => [
                    new Email(),
                    new NotBlank()
                ],
                'attr' => [
                    'placeholder' => 'adresse@email.com'
                ],
                'label' => false,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Réinitialiser mon mot de passe',
                'attr' => [
                    'class' => 'btn btnLogin',
                ],
            ])
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            // voir l'épisode 2 de cette série pour retrouver la méthode loadUserByUsername:
            $email = $form->getData()['email'];
            $user = $repo->findBy(['email' => $email]);

            // aucun email associé à ce compte.
            if (!$user) {
                $this->addFlash('warning', "Cet email n'existe pas.");
                return $this->redirectToRoute("reset_password");
            }

            // création du token
            //dd($user);
            $user[0]->setToken($tokenGenerator->generateToken());
            // enregistrement de la date de création du token
            $user[0]->setTokenCreatedAt(new \DateTime());
            $em->flush();

            $message = (new \Swift_Message('Playfulkit - Mot de passe oublié'))
                ->setFrom($this->getParameter('mailer_from'))
                ->setTo($email)
                ->setBody(
                    $this->renderView(
                        'email/resetPassword.html.twig',
                        ['user' => $user[0]]
                    ),
                    'text/html'
                );
            $mailer->send($message);
            $this->addFlash('success', "Ta demande a été prise en compte, tu vas recevoir un email !");

            return $this->redirectToRoute("app_login");
        }

        return $this->render('reset/request.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/{id}/{token}", name="resetting")
     */
    public function resetting(User $user, $token, Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        // interdit l'accès à la page si:
        // le token associé au membre est null
        // le token enregistré en base et le token présent dans l'url ne sont pas égaux
        // le token date de plus de 10 minutes
        if ($user->getToken() === null || $token !== $user->getToken()) {
            throw new AccessDeniedHttpException();
        }

        $form = $this->createForm(ResettingType::class, $user);
        $form->handleRequest($request);

        //dd($form->getData()->get('plainPassword'));

        if ($form->isSubmitted() && $form->isValid()) {
            $password = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);

            // réinitialisation du token à null pour qu'il ne soit plus réutilisable
            $user->setToken(null);
            $user->setTokenCreatedAt(null);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('success', "Ton mot de passe a été changé !");

            return $this->redirectToRoute('app_login');
        }

        return $this->render('reset/index.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/message", name="logout_message")
     */
    public function logoutMessage()
    {
        $this->addFlash('warning', 'Tu as été déconnecté.');
        return $this->redirectToRoute('app_index');
    }

    /**
     * @Route("/logout", name="app_logout", methods={"GET"})
     */
    public function logout()
    {
        throw new \Exception('Don\'t forget to activate logout in security.yaml');
    }
}
