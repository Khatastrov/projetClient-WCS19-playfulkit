<?php
namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/contact")
 */
class ContactController extends AbstractController
{
    /**
     * @Route("/", name="contact", methods={"GET","POST"})
     */
    public function new(Request $request, \Swift_Mailer $mailer): Response
    {
        $contact = new Contact();
        $user = $this->getUser();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();

            $email = $form->getData()->getEmail();

            $message = (new \Swift_Message('Playfulkit - J\'ai bien reçu ton message !'))
                ->setFrom($this->getParameter('mailer_from'))
                ->setTo($email)
                ->setBody(
                    $this->renderView(
                        'email/contactConfirmation.html.twig',
                        ['people' => $form->getData()]
                    ),
                    'text/html'
                );
            $mailer->send($message);

            $message2 = (new \Swift_Message('Playfulkit Admin - Tu as reçu un nouveau message !'))
                ->setFrom($this->getParameter('mailer_from'))
                ->setTo($this->getParameter('mailer_from'))
                ->setBody(
                    $this->renderView(
                        'email/contactNotification.html.twig',
                        ['people' => $form->getData()]
                    ),
                    'text/html'
                );
            $mailer->send($message2);

            $this->addFlash('success', 'Ton message a bien été envoyé !');
            return $this->redirectToRoute('app_index');
        }


        return $this->render('contact/_form.html.twig', [
            'contact' => $contact,
            'form' => $form->createView(),
            'user' => $user,
        ]);
    }
}
