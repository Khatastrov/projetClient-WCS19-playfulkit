<?php

namespace App\Controller;

use App\Entity\BlogPost;
use App\Form\BlogPostType;
use App\Repository\BlogPostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BlogPostController extends AbstractController
{
    /**
     * @Route("/blog/post", name="blog_post")
     */
    public function index(BlogPostRepository $repo)
    {
        $posts = $repo->findAll();

        return $this->render('blog_post/index.html.twig', [
            'posts' => $posts,
        ]);
    }
    
    /**
     * @Route ("/blog/new", name="new_post")
     */
    public function new(Request $request)
    {
        $post = new BlogPost();
        $user = $this->getUser();
        $form = $this->createForm(BlogPostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post->setAuthor($user);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($post);
            $entityManager->flush();

            return $this->redirectToRoute('blog_post');
        }

        return $this->render('blog_post/new.html.twig', [
            'post' => $post,
            'form' => $form->createView()
        ]);
    }
}
