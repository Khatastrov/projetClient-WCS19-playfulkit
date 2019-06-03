<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserSignUpType;
use App\Form\UserProfileType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/new", name="user_new", methods={"GET","POST"})
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

        return $this->render('user/formSignUp.html.twig', [
            'user' => $userSignUp,
            'form' => $form->createView()
        ]);
    }
    
      /**
       * @Route("/{id}", name="user_show")
       */
    public function show(User $user)
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

      /**
       * @Route("/{id}/edit", name="user_edit", methods={"GET","POST"})
       */
    public function edit(Request $request, User $user): Response
    {
        $form = $this->createForm(UserProfileType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_show', [
                'id' => $user->getId(),
            ]);
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}
