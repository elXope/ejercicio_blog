<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('page/index.html.twig', []);
    }

    #[Route('/services', name:'services')]
    public function services(): Response
    {
        return $this->render('page/services.html.twig', []);
    }

    #[Route('/contact', name:'contact')]
    public function contact(): Response
    {
        return $this->render('page/contact.html.twig', []);
    }
}
