<?php


namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
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

        return $this->render('default.html.twig', [
            'user' => $registrationForm,
            'form' => $form->createView()
        ]);
    }
}
