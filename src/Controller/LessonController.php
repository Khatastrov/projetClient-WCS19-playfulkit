<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Lesson;
use App\Entity\Tool;
use App\Form\LessonType;
use App\Repository\CategoryRepository;
use App\Repository\LessonRepository;
use App\Repository\ToolRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/lesson")
 */
class LessonController extends AbstractController
{
    /**
     * @Route("/", name="lesson_index", methods={"GET"})
     */
    public function index(LessonRepository $lessonRepository): Response
    {
        return $this->render('lesson/index.html.twig', [
            'lessons' => $lessonRepository->findBy(
                [],
                ['publicationDate' => 'DESC']
            ),
        ]);
    }

    /**
     * @Route("/category/{name}", name="lesson_category", methods={"GET"})
     * @param Category $category
     * @return Response
     */
    public function categoryIndex(Category $category): Response
    {
        return $this->render('lesson/category.html.twig', [
            'lessons' => $category->getLessons(),
            'category' => $category,
        ]);
    }

    /**
     * @Route("/{id}", name="lesson_show", methods={"GET"})
     * @param Lesson $lesson
     * @return Response
     */
    public function show(LessonRepository $lessonRepository, Lesson $lesson): Response
    {
        $latest = $lessonRepository->findBy(
            [],
            ['publicationDate' => 'DESC',],
            3
        );

        $tools = $lesson->getTool()->getValues();
        $handtools= array();
        $hardwares= array();
        $softwares= array();

        foreach ($tools as $key => $tool) {
            if ($tool->getCategory() == 'handtool') {
                array_push($handtools, $tool);
            } elseif ($tool->getCategory() == 'software') {
                array_push($softwares, $tool);
            } elseif ($tool->getCategory() == 'hardware') {
                array_push($hardwares, $tool);
            }
        }

        return $this->render('lesson/show.html.twig', [
            'lesson' => $lesson,
            'latest' => $latest,
            'handtools' => $handtools,
            'softwares' => $softwares,
            'hardwares' => $hardwares,
        ]);
    }
}
