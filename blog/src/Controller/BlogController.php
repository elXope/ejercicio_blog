<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\{Response, Request};
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Post;
use App\Form\PostFormType;

class BlogController extends AbstractController
{
    #[Route('/blog', name: 'blog')]
    public function blog(): Response
    {
        return $this->render('blog/index.html.twig', []);
    }

    #[Route('/blog/new', name:'new_post')]
    public function newPost(ManagerRegistry $doctrine, Request $request): Response {
        $post = new Post();
        $form = $this->createForm(PostFormType::class, $post);

        return $this->render('blog/new_post.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
