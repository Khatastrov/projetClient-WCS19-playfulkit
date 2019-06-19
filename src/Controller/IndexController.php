<?php


namespace App\Controller;

use App\Entity\User;
use App\Form\UserSignUpType;
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
    public function index(Request $request, UserPasswordEncoderInterface $encoder) : Response
    {
        $userSignUp = new User();
        $form = $this->createForm(UserSignUpType::class, $userSignUp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hash = $encoder->encodePassword($userSignUp, $userSignUp->getPassword());
            $userSignUp->setPassword($hash);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($userSignUp);
            $entityManager->flush();

            return $this->redirectToRoute('user_login');
        }

        return $this->render('default.html.twig', [
            'user' => $userSignUp,
            'form' => $form->createView()
        ]);
    }
}