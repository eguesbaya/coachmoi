<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TrainingSpaceRepository;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(TrainingSpaceRepository $trainingSpaceRepo): Response
    {
        return $this->render('home/index.html.twig', [
            'training_spaces' => $trainingSpaceRepo->findAll(),
        ]);
    }
}
