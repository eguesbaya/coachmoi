<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileCoachController extends AbstractController
{
    /**
     * @Route("/profile/coach", name="profile_coach")
     */
    public function index(): Response
    {
        return $this->render('profile_coach/index.html.twig');
    }
}
