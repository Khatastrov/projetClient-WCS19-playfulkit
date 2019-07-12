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
    public function index(Request $request, \Swift_Mailer $mailer): Response
    {
        $client = new InterestedPeople();

        $form = $this->createForm(InterestedPeopleType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($client);
            $entityManager->flush();

            $email = $form->getData()->getEmail();

            $message = (new \Swift_Message('Playfulkit - Tu t\'es inscris au concours !'))
                ->setFrom($this->getParameter('mailer_from'))
                ->setTo($email)
                ->setBody(
                    $this->renderView(
                        'email/contestConfirmation.html.twig',
                        ['people' => $form->getData()]
                    ),
                    'text/html'
                );
            $mailer->send($message);

            $this->addFlash('success', 'Ton insciption a été prise en compte ! En route pour l\'aventure !');
            return $this->redirectToRoute('app_index');
        }

        return $this->render('contest/index.html.twig', [
            'form' => $form->createView(),
            ]);
    }
}
