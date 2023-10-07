<?php

namespace App\Controller;

use App\Entity\User;
use Illuminate\Http\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    public function registration(UserPasswordHasherInterface $passwordHasher, Request $request): void
    {
        $user = new User();
        $password = $request->request->get('password');
        $firstname = $request->request->get('first');
        $lastname = $request->request->get('last');
        $email = $request->request->get('email');
        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $password,
        );
        $user->setPassword($hashedPassword);
    }

    public function delete(UserPasswordHasherInterface $passwordHasher, UserInterface $user): void
    {
/*        $plaintextPassword = ...;

        if (!$passwordHasher->isPasswordValid($user, $plaintextPassword)) {
            throw new AccessDeniedHttpException();
        }*/
    }
}
