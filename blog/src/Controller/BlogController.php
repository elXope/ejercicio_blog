<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\{Response, Request};
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Post;
use App\Form\PostFormType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\String\Slugger\SluggerInterface;

class BlogController extends AbstractController
{
    #[Route('/blog', name: 'blog')]
    public function blog(): Response
    {
        return $this->render('blog/index.html.twig', []);
    }

    #[Route('/blog/new', name:'new_post')]
    public function newPost(ManagerRegistry $doctrine, Request $request, SluggerInterface $slugger): Response {
        $post = new Post();
        $form = $this->createForm(PostFormType::class, $post);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('imagen')->getData();
            if ($file) {
                $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

                try {
                    $file->move(
                        $this->getParameter('images_directory'), $newFilename
                    );
                } catch (FileException $e) {
                    exit;
                }

                $post->setImagen($newFilename);
            }
            $post = $form->getData();
            $post->setNLikes(0);
            $post->setFecha(new \DateTime());
            $entityManager = $doctrine->getManager();
            $entityManager->persist($post);
            $entityManager->flush();
        }

        return $this->render('blog/new_post.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
