<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Coach;
use App\Repository\CoachRepository;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(CoachRepository $coachRepository): Response
    {
        $coachs = $coachRepository->findAll();

        return $this->render('home/index.html.twig', [
            'coachs' => $coachs,
        ]);
    }
}
