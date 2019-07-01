<?php

namespace App\Controller;

use App\Entity\BlogPost;
use App\Repository\BlogPostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/blog/post")
 */
class BlogPostController extends AbstractController
{
    /**
     * @Route("/", name="blog_index", methods={"GET"})
     */
    public function index(BlogPostRepository $blogPostRepository): Response
    {
        return $this->render('blog_post/index.html.twig', [
            'blog_posts' => $blogPostRepository->findBy(
                [],
                ['creationDate' => 'DESC']
            ),
        ]);
    }

    /**
     * @Route("/{id}", name="blog_show", methods={"GET"})
     */
    public function show(BlogPost $blogPost, BlogPostRepository $repo): Response
    {
        $latest = $repo->findBy(
            [],
            ['creationDate' => 'DESC',],
            3
        );

        return $this->render('blog_post/show.html.twig', [
            'post' => $blogPost,
            'latest' => $latest,
        ]);
    }
}
