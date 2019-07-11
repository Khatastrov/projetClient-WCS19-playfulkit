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
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();
            $message = (new \Swift_Message(
                'Message',
                'Tu viens de recevoir un nouveau message sur PLayfulkit.'
            ))
                ->setFrom('adresse@gmail.com')
                ->setTo('adresse@gmail.com');
            $mailer->send($message);
        }
        return $this->render('contact/_form.html.twig', [
            'contact' => $contact,
            'form' => $form->createView(),
        ]);
    }
}
