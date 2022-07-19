<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class CategoryController extends AbstractController
{
    #[Route('/category', name: 'category')]
    public function index(): Response
    {
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }

    #[Route('/category/create', name: 'addCategory')]
    public function create(Environment $twig, Request $request, EntityManagerInterface $manager): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);

        $category->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
        $manager->persist($category);
        $manager->flush();
        return $this->redirectToRoute('home');
        ]);
    }
}
