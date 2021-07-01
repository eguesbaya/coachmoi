<?php

namespace App\Controller;

use App\Repository\CoachRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfileCoachController extends AbstractController
{
    /**
     * @Route("/profile/coach", name="profile_coach")
     */
    public function index(CoachRepository $coach): Response
    {

        return $this->render('profile_coach/index.html.twig');
    }
}
