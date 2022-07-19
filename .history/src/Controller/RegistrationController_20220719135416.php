<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;


class RegistrationController extends AbstractController
{
    #[Route('/registration', name: 'registration')]
    public function index(Request $request,EntityManagerInterface $manager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
          $user->setPassword($passwordHasher->hashPassword(
                $user, 
                $form->ge
            ));
            $manager->persist($user);
            $manager->flush();

            
            return $this->redirectToRoute('home');
        }
        return $this->render('registration/index.html.twig', [
            'registration_form' => $form->createView()
        ]);
    }
}
