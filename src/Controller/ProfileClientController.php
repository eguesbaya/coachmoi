<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfileClientController extends AbstractController
{
    /**
     * @Route("/profile/client", name="profile_client")
     */
    public function index(UserRepository $userRepository): Response
    {
        $user = $this->getUser();

        return $this->render('profile_client/index.html.twig', [
            'user' => $user,
        ]);
    }
}
