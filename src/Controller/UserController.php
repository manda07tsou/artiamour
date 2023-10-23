<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/create-user", name="app_user_create")
     */
    public function index(
        UserRepository $ur,
        UserPasswordHasherInterface $passwordHasher
    )
    {
        $user = (new User())
            ->setMail("artiamourhw@gmail.com");
        $password = $passwordHasher->hashPassword($user, "artiamour_default");
        $user->setPassword($password);
        $ur->add($user, 1);
        return $this->redirectToRoute('app_auth');
    }
}
