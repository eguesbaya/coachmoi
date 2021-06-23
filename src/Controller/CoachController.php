<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Coach;
use App\Repository\CoachRepository;

/**
 * @Route("/coachs", name="coachs_")
 */
class CoachController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(CoachRepository $coachRepository): Response
    {
        return $this->render('coach/index.html.twig', [
            'coachs' => $coachRepository->findAll(),
        ]);
    }
}
