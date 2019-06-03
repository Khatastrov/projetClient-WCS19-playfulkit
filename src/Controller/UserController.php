<?php


namespace App\Controller;

use App\Entity\User;
use App\Form\UserSignUpType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user/new", name="user_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request) : Response
    {
        $userSignUp = new User();
        $form = $this->createForm(UserSignUpType::class, $userSignUp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userSignUp->setPassword(password_hash($userSignUp->getPassword(), PASSWORD_DEFAULT));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($userSignUp);
            $entityManager->flush();

            return $this->redirectToRoute('user_show');
        }

        return $this->render('user/new.html.twig', [
            'user' => $userSignUp,
            'form' => $form->createView()
        ]);
    }
}
