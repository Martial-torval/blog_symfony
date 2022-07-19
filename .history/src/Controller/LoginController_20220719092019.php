<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\LoginFormType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function index(Request $request,EntityManagerInterface $manager): Response
    {

        $user = new User();
        $form = $this->createForm(LoginFormType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $manager->persist($request);
            $manager->flush($user);

            return $this->redirectToRoute('home');
        }
        return $this->render('login/index.html.twig', [
            'login_form' => $form->createView(())
        ]);
    }
}
