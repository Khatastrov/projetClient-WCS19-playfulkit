<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Lesson;
use App\Form\LessonType;
use App\Repository\LessonRepository;
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
            'lessons' => $lessonRepository->findAll(),
        ]);
    }

    /**
     * @Route("/category/{name}", name="lesson_category", methods={"GET"})
     * @param Category $category
     * @return Response
     */
    public function categoryIndex(LessonRepository $lessonRepository, Category $category): Response
    {
        return $this->render('lesson/category.html.twig', [
            'category' => $category,
            'lessons' => $lessonRepository->findBy([
                'category' => $category,
            ]),
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
            ['id' => 'DESC',],
            3
        );

        return $this->render('lesson/show.html.twig', [
            'lesson' => $lesson,
            'latest' => $latest,
        ]);
    }
}
