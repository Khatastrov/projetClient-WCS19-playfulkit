<?php

namespace App\Controller;

use App\Entity\Tutorial;
use App\Form\TutorialType;
use App\Repository\TutorialRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TutorialController extends AbstractController
{
    /**
     * @Route("/tutorial", name="tutorial")
     */
    public function index(TutorialRepository $repo)
    {
        $tuto = $repo->findAll();

        return $this->render('tutorial/index.html.twig', [
            'tutorials' => $tuto
        ]);
    }


    /**
     * @Route("/tutorial/new", name="tutorial_create")
     * @Route("/tutorial/{id}/edit", name="tutorial_edit")
     */
    public function form(Tutorial $tuto = null, Request $request)
    {
        if (!$tuto) {
            $tuto = new Tutorial();
        }

        $form = $this->createForm(TutorialType::class, $tuto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (!$tuto->getId()) {
                $tuto->setDateCreation(new \DateTime());
            }

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($tuto);
            $manager->flush();

            return $this->redirectToRoute('tutorial_show', [
                'id' => $tuto->getId()
            ]);
        }

        return $this->render('tutorial/create.html.twig', [
            'formTutorial' => $form->createView(),
            'editMode' => $tuto->getId() !== null,
        ]);
    }


    /**
     * @Route("/tutorial/{id}", name="tutorial_show")
     */
    public function show(Tutorial $tuto)
    {
        return $this->render('tutorial/show.html.twig', [
            'tuto' => $tuto
        ]);
    }
}
