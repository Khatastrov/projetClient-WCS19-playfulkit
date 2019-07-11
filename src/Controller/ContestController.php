<?php


namespace App\Controller;

use App\Entity\InterestedPeople;
use App\Form\InterestedPeopleType;
use App\Repository\InterestedPeopleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContestController extends AbstractController
{
    /**
     * @Route("/contest", name="contest")
     */
    public function index(Request $request): Response
    {
        $client = new InterestedPeople();

        $form = $this->createForm(InterestedPeopleType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($client);
            $entityManager->flush();

            $this->addFlash('success', 'Ton adresse est enregistrée ! Bien joué l\'ami !');
            return $this->redirectToRoute('app_index');
        }

        return $this->render('contest/index.html.twig', [
            'form' => $form->createView(),
            ]);
    }
}
