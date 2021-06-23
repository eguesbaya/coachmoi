<?php

namespace App\Controller;

use App\Entity\TrainingSpace;
use App\Repository\TrainingSpaceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TrainingSpaceController extends AbstractController
{
    /**
     * @Route("/espaces", name="training_space")
     */
    public function index(TrainingSpaceRepository $trainingSpaceRepo): Response
    {
        return $this->render('training_space/index.html.twig', [
            'training_spaces' => $trainingSpaceRepo->findAll(),
        ]);
    }
}
