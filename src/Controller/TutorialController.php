<?php

namespace App\Controller;

use App\Entity\Tutorial;
use App\Entity\TutorialTool;
use App\Form\TutorialToolType;
use App\Entity\TutorialStep;
use App\Form\TutorialType;
use App\Repository\ToolRepository;
use App\Repository\TutorialRepository;
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
    public function index(TutorialRepository $repo) : Response
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
     * @return Response
     * @throws \Exception
     */
    public function form(Tutorial $tuto = null, Request $request, ToolRepository $repo) : Response
    {
        $user = $this->getUser();
        if (!$tuto) {
            $tuto = new Tutorial();
            $tuto->setAuthor($user);
        }

        //dd($tuto->getTools());

        $form = $this->createForm(TutorialType::class, $tuto);
        $tutorial = $request->request->get('tutorial');

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (!$tuto->getId()) {
                $tuto->setDateCreation(new \DateTime());

                if ($tuto->getIllustration() != null) {
                    parse_str(parse_url($tuto->getIllustration(), PHP_URL_QUERY), $link);
                    $tuto->setIllustration($link['v']);
                }
            }

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($tuto);
            $manager->flush();

            if ($tutorial['tools'] != null) {
                $tutoTool = new TutorialTool();
                foreach ($tutorial['tools'] as $key => $value) {
                    $tool = $repo->find($value['tool']);
                    $tutoTool->setTool($tool);
                    $tutoTool->setQuantity($value['quantity']);
                    $tutoTool->setTutorial($tuto);
                    $manager->persist($tutoTool);
                }
                $manager->flush();
            }

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
     * @param Tutorial $tuto
     * @return Response
     */
    public function show(Tutorial $tuto) : Response
    {
        $tools = $tuto->getTools()->getValues();
        $handtools = [];
        $softwares = [];
        $hardwares = [];

        foreach ($tools as $key => $tool) {
            $category = $tool->getTool()->getCategory();
            switch ($category) {
                case 'handtool':
                    array_push($handtools, $tool);
                    break;
                case 'software':
                    array_push($softwares, $tool);
                    break;
                case 'hardware':
                    array_push($hardwares, $tool);
                    break;
            }
        }

        return $this->render('tutorial/show.html.twig', [
            'tuto' => $tuto,
            'handtools' => $handtools,
            'softwares' => $softwares,
            'hardwares' => $hardwares,
        ]);
    }
}
