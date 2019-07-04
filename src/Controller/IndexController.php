<?php


namespace App\Controller;

use App\Entity\BlogPost;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\BlogPostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="app_index")
     */
    public function index(Request $request, UserPasswordEncoderInterface $encoder, BlogPostRepository $repo) : Response
    {
        $registrationForm = new User();
        $form = $this->createForm(RegistrationFormType::class, $registrationForm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hash = $encoder->encodePassword($registrationForm, $registrationForm->getPassword());
            $registrationForm->setPassword($hash);
            $registrationForm->setCreatedAt(new \DateTime());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($registrationForm);
            $entityManager->flush();

            return $this->redirectToRoute('app_index');
        }
        $latest = $repo->findBy(
            [],
            ['creationDate' => 'DESC',],
            3
        );


        return $this->render('default.html.twig', [
            'user' => $registrationForm,
            'form' => $form->createView(),
            'latest' => $latest,
        ]);
    }
}
