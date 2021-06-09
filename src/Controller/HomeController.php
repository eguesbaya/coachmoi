<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Activity;
use App\Repository\ActivityRepository;
use App\Repository\TrainingSpaceRepository;

class HomeController extends AbstractController
{

    private const MAX_ACTIVITY = 6;
    /**
     * @Route("/", name="home")
     */
    public function index(ActivityRepository $activityRepository, TrainingSpaceRepository $trainingSpaceRepo): Response
    {
        $activities = $activityRepository
            ->findBy(['isFeatured' => 'true'], ['name' => 'ASC'], self::MAX_ACTIVITY);

        return $this->render('home/index.html.twig', [
            'activities' => $activities,
            'training_spaces' => $trainingSpaceRepo->findAll()
            ]);
    }
}
