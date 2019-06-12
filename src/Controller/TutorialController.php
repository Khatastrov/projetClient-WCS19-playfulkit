<?php

namespace App\Controller;

use App\Entity\Tutorial;
use App\Form\TutorialVideoType;
use App\Repository\TutorialRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TutorialController extends AbstractController
{
    /**
     * @Route("/tutorial", name="tutorial")
     * @param TutorialRepository $repo
     * @return Response
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
     * @param Tutorial|null $tuto
     * @param Request $request
     * @param ObjectManager $manager
     * @return Response
     * @throws \Exception
     */
    public function form(Tutorial $tuto = null, Request $request, ObjectManager $manager) : Response
    {
        if (!$tuto) {
            $tuto = new Tutorial();
        }

        $form = $this->createForm(TutorialVideoType::class, $tuto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (!$tuto->getId()) {
                $tuto->setDateCreation(new \DateTime());
            }

            $manager->persist($tuto);
            $manager->flush();

            return $this->redirectToRoute('tutorial_show', [
                'id' => $tuto->getId()
            ]);
        }

        return $this->render('tutorial/create.html.twig', [
            'formTutorial' =>$form->createView(),
            'editMode' => $tuto->getId() !== null,
        ]);
    }


    /**
     * @Route("/tutorial/{id}", name="tutorial_show")
     * @param Tutorial $tuto
     * @return Response
     */
    public function show(Tutorial $tuto) : Response
    {
        return $this->render('tutorial/show.html.twig', [
            'tuto' => $tuto
        ]);
    }
}
