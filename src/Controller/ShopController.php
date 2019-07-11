<?php

namespace App\Controller;

use App\Entity\InterestedPeople;
use App\Form\InterestedPeopleType;
use App\Repository\InterestedPeopleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ShopController extends AbstractController
{
    /**
     * @Route("/shop", name="shop")
     */
    public function register(Request $request, InterestedPeopleRepository $repo, \Swift_Mailer $mailer)
    {
        $client = new InterestedPeople();

        $form = $this->createForm(InterestedPeopleType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($client);
            $entityManager->flush();

            $email = $form->getData()->getEmail();

            $message = (new \Swift_Message('Playfulkit - Tu es inscris à la newsletter !'))
                ->setFrom($this->getParameter('mailer_from'))
                ->setTo($email)
                ->setBody(
                    $this->renderView(
                        'email/shopRegistration.html.twig',
                        ['people' => $form->getData()]
                    ),
                    'text/html'
                );
            $mailer->send($message);


            $this->addFlash('success', 'Ton adresse est enregistrée ! Bien joué l\'ami !');
            return $this->redirectToRoute('app_index');
        }

        $count = count($repo->findAll());

        return $this->render('shop/index.html.twig', [
            'form' => $form->createView(),
            'compte' => $count
        ]);
    }
}
