<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('post/create', name: 'form_create')]
    public function create(Environment $twig): Response
    {

        $post = new Post();

        $form = $this->createForm(PostFormType::class, $post); // On donne à $form la methode "createForm" Contenu dans "AbstractController" et on donne en paramêtre notre Formulaire Symphony pour pouvoir
        return new Response($twig->render('post/index.html.twig', [
            'post_form' => $form->createView()
        ]));
}
}
