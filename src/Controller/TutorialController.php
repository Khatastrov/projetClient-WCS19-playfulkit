<?php

namespace App\Controller;

use App\Entity\Tutorial;
use App\Form\TutorialType;
use App\Repository\ToolRepository;
use App\Repository\TutorialRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/tutorial")
 */
class TutorialController extends AbstractController
{
    /**
     * @Route("/", name="tutorial_index", methods={"GET"})
     * @param TutorialRepository $tutorialRepository
     * @return Response
     */
    public function index(TutorialRepository $tutorialRepository): Response
    {
        $tuto = $tutorialRepository->findBy([
            'isPublished' => true,
        ]);

        return $this->render('tutorial/index.html.twig', [
            'tutorials' => $tuto,
        ]);
    }

    /**
     * @Route("/new", name="tutorial_new", methods={"GET","POST"})
     * @param Request $request
     * @param ToolRepository $toolRepository
     * @return Response
     * @throws \Exception
     */
    public function new(Request $request, ToolRepository $toolRepository): Response
    {
        $user = $this->getUser();

        if ($user) {
            $tutorial = new Tutorial();
            $tutorial->setAuthor($user);
            $form = $this->createForm(TutorialType::class, $tutorial);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $tutorial->setDateCreation(new \DateTime());
                if ($tutorial->getIllustration() != null) {
                    parse_str(parse_url($tutorial->getIllustration(), PHP_URL_QUERY), $link);
                    $tutorial->setIllustration($link['v']);
                }

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($tutorial);
                $entityManager->flush();

                return $this->redirectToRoute('tutorial_show', [
                    'id' => $tutorial->getId(),
                ]);
            } else {
                return $this->render('tutorial/new.html.twig', [
                    'tutorial' => $tutorial,
                    'form' => $form->createView(),
                ]);
            }
        } else {
            $this->addFlash('danger', 'Tu dois être connecté pour déposer un tutoriel !');
            return $this->redirectToRoute('app_login');
        }
    }

    /**
     * @Route("/{id}", name="tutorial_show", methods={"GET"})
     * @param Tutorial $tutorial
     * @return Response
     */
    public function show(Tutorial $tutorial): Response
    {
        $tools = $tutorial->getTools();
        $handtools = [];
        $softwares = [];
        $hardwares = [];
        foreach ($tools as $key => $tool) {
            $category = $tool->getCategory();
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
            'tutorial' => $tutorial,
            'handtools' => $handtools,
            'softwares' => $softwares,
            'hardwares' => $hardwares,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="tutorial_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Tutorial $tutorial
     * @param ToolRepository $toolRepository
     * @return Response
     */
    public function edit(Request $request, Tutorial $tutorial, ToolRepository $toolRepository): Response
    {
        $form = $this->createForm(TutorialType::class, $tutorial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($tutorial->getIllustration() != null) {
                parse_str(parse_url($tutorial->getIllustration(), PHP_URL_QUERY), $link);
                if ($link['v']) {
                    $tutorial->setIllustration($link['v']);
                }
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tutorial_show', [
                'id' => $tutorial->getId(),
            ]);
        }

        return $this->render('tutorial/edit.html.twig', [
            'tutorial' => $tutorial,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tutorial_delete", methods={"DELETE"})
     * @param Request $request
     * @param Tutorial $tutorial
     * @return Response
     */
    public function delete(Request $request, Tutorial $tutorial): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tutorial->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tutorial);
            $entityManager->flush();
        }
        return $this->redirectToRoute('tutorial_index');
    }
}
