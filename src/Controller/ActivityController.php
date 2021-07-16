<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Activity;
use App\Repository\ActivityRepository;

/**
 * @Route("/activite", name="activity")
 */


class ActivityController extends AbstractController
{
    /**
     * @Route("/", name="")
     */
    public function index(ActivityRepository $activityRepository): Response
    {
        $activities = $activityRepository->findBy([], ['name' => 'ASC']);

        return $this->render(
            'activity/index.html.twig',
            ['activities' => $activities]
        );
    }
}
