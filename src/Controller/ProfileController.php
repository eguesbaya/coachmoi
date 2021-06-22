<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Coach;
use App\Repository\CoachRepository;

/**
 * @Route("/profile", name="profile_")
 */
class ProfileController extends AbstractController
{
    /**
     * @Route("/coach", name="coach_read")
     */
    public function readCoach(CoachRepository $coachRepository): Response
    {
        return $this->render('profile/index_coach.html.twig');
    }

    public function editCoach(CoachRepository $coachRepository): Response
    {
        return $this->render('profile/edit_coach.html.twig');
    }
}
