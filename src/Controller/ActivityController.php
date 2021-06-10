<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Activity;
use App\Repository\ActivityRepository;

class ActivityController extends AbstractController
{
    /**
     * @Route("/activity", name="activity")
     */
    public function index(ActivityRepository $activityRepository): Response
    {
        $activities = $activityRepository->findAll();

        return $this->render(
            'activity/index.html.twig',
            ['activities' => $activities]
        );
    }
}
