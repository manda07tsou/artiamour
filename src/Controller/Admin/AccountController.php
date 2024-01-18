<?php

namespace App\Controller\Admin;

use App\Form\ChangePasswordType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AccountController extends AbstractController
{
    #[Route('/admin/account', name: 'admin_account')]
    public function index(
        Request $request,
        UserPasswordHasherInterface $passwordHasher,
        UserRepository $ur
    ): Response
    {
        $form = $this->createForm(ChangePasswordType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $user = $this->getUser();
            $password = $passwordHasher->hashPassword($user, $form->getData()['password']);
            $user->setPassword($password);
            $ur->add($user, 1);
            $this->addFlash('success', 'Mot de passe modifié avec succées');
            return $this->redirectToRoute('admin_home');
        }
        
        return $this->render('admin/account/index.html.twig', 
            [
                'form' => $form->createView()
            ]
        );
    }
}
