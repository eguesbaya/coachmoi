<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Coach;
use App\Repository\CoachRepository;
use App\Repository\TrainingSpaceRepository;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(CoachRepository $coachRepository, TrainingSpaceRepository $trainingSpaceRepo): Response
    {
        $coachs = $coachRepository->findAll();

        return $this->render('home/index.html.twig', [
            'coachs' => $coachs,
            'training_spaces' => $trainingSpaceRepo->findAll(),
        ]);
    }
}
