<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    #[Route('/post', name: 'post')]
    public function index(): Response
    {
        return $this->render('blpostog/index.html.twig', [
            'controller_name' => 'PostController',
        ]);
    }
}
