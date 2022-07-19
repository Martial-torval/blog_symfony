<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class registrationController extends AbstractController
{
    #[Route('/registration', name: 're')]
    public function index(Request $request,EntityManagerInterface $manager): Response
    {

        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $manager->persist($request);
            $manager->flush($user);

            return $this->redirectToRoute('home');
        }
        return $this->render('login/index.html.twig', [
            'registration_form' => $form->createView()
        ]);
    }
}
