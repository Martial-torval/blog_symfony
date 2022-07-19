<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostFormType;
use App\Repository\CategoryRepository;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use PhpParser\Builder\Method;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(PostRepository $repo ,CategoryRepository $categoryRepository, Request $request): Response
    {   
        dd($request);

        // $filterPost = new Post();
        // $form = $this->createFormBuilder($filterPost);
        // $form 
        // ->add('category', EntityType::class, [
        //     'class' => Post::class,
        //     'choice_label' => 'Sort By',
        //     // 'expanded' => true, // For checkbox
        //     // 'multiple' => true // For checkbox
        // ])
        // ->add('category', EntityType::class, [
        //     'class' => Category::class,
        //     'choice_label' => 'By Category',
        //     // 'expanded' => true, // For checkbox
        //     // 'multiple' => true // For checkbox
        // ])
        // ->getForm();    
        
        $post = $repo->findAll();
        $category = $repo->findAll();
        return $this->render('home/index.html.twig', [
            'post' => $post,
            'category', $categoryy
            // 'form' => $form->createView()
        ]);
    }

    #[Route('post/create', name: 'form_create')]
    public function create(Environment $twig, Request $request, EntityManagerInterface $manager): Response
    {

        $post = new Post();

        $form = $this->createForm(PostFormType::class, $post); 
        // dump($request);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            // $post->setCreatedAt(new \DateTime());
            $post->setCreatedAt(new \DateTimeImmutable());
            $manager->persist($post);
            $manager->flush();
            return $this->redirectToRoute('home');
        }
        return new Response($twig->render('post/index.html.twig', [
            'post_form' => $form->createView()
        ]));
}
#[Route('post/show{id}', name: 'show', methods:'GET')]
public function show($id, PostRepository $repo) {
   $post = $repo->find($id);
   
//    dd($post);

return $this->render('post/detailPost.html.twig',['post' => $post]);
}
}
