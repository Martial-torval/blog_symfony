<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function create(Environment $twig, Request $request, EntityManagerInterface $manager): Response
    {

        $post = new Post();

        $form = $this->createForm(PostFormType::class, $post); // On donne à $form la methode "createForm" Contenu dans "AbstractController" et on donne en paramêtre notre Formulaire Symphony pour pouvoir
        // dump($form)
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            // $post->setCreatedAt(new \DateTime());
            $manager->persist($post);
            $manager->flush();
            return $this->redirectToRoute('home', [
                'post' => $post,
            ]);
        }
        return new Response($twig->render('post/index.html.twig', [
            'post_form' => $form->createView()
        ]));
}
}
