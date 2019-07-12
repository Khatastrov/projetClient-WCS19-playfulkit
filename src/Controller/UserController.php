<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Form\EditPasswordType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
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
     * @Route("/{id}", name="user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        if ($this->getUser() != null) {
            if ($this->getUser()->getId() == $user->getId()) {
                return $this->render('user/show.html.twig', [
                    'user' => $user,
                    'firstName' => $user->getFirstname(),
                    'lastName' => $user->getLastname(),
                    'address' => $user->getAddress(),
                ]);
            } else {
                $this->addFlash('danger', 'Tu ne peux pas accèder à cette page');
                return $this->redirectToRoute('app_index');
            }
        } else {
            $this->addFlash('warning', 'Tu dois d\'abord te connecter avant d\'accèder à ton profil !');
            return $this->redirectToRoute('app_login');
        }
    }

    /**
     * @Route("/{id}/edit", name="user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Ton profil a bien été modifié !');
            return $this->redirectToRoute('user_show', [
                'id' => $user->getId(),
            ]);
        }
        if ($this->getUser() != null) {
            if ($this->getUser()->getId() == $user->getId()) {
                return $this->render('user/edit.html.twig', [
                    'user' => $user,
                    'form' => $form->createView(),
                ]);
            } else {
                return $this->render('/default.html.twig');
            }
        } else {
            return $this->render('/default.html.twig');
        }
    }

    /**
     * @Route("/{id}/edit/password", name="user_password_edit", methods={"GET","POST"})
     */
    public function editPassword(Request $request, User $user, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $form = $this->createForm(EditPasswordType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('password')->getData()
                )
            );
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Ton mot de passe a bien été modifié !');
            return $this->redirectToRoute('user_show', [
                'id' => $user->getId(),
            ]);
        }

        return $this->render('user/editPassword.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_index');
    }
}
