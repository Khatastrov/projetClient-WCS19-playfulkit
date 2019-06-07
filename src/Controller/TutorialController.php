<?php

namespace App\Controller;

use App\Entity\Tutorial;
use App\Form\TutorialType;
use App\Repository\TutorialRepository;
use App\Service\FileUploader;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
     * @param Tutorial|null $tuto
     * @param Request $request
     * @param ObjectManager $manager
     * @param FileUploader $fileUploader
     * @return Response
     * @throws \Exception
     */
    public function form(Tutorial $tuto = null, Request $request, ObjectManager $manager, FileUploader $fileUploader)
    : Response
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

            $file = new FileUploader($tuto->getIllustration());
            $fileName= $fileUploader->upload($file);


            $tuto->setIllustration($fileName);

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
     */
    public function show(Tutorial $tuto)
    {
        return $this->render('tutorial/show.html.twig', [
            'tuto' => $tuto
        ]);
    }

}
