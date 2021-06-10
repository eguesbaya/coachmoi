<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Activity;
use App\Repository\ActivityRepository;

/**
 * @Route("/activity", name="activity")
 */


class ActivityController extends AbstractController
{
    /**
     * @Route("/", name="")
     */
    public function index(ActivityRepository $activityRepository): Response
    {
        $activities = $activityRepository->findAll();

        return $this->render(
            'activity/index.html.twig',
            ['activities' => $activities]
        );
    }

    /**
    * @Route("/az", name="_AtoZ")
    */
    public function aToZ(ActivityRepository $activityRepository): Response
    {
        $activities = $activityRepository->findBy([], ['name' =>'ASC']); //sort A to Z

        return $this->render(
            'activity/index.html.twig',
            ['activities' => $activities]
        );
    }

    /**
    * @Route("/za", name="_ZtoA")
    */
    public function zToA(ActivityRepository $activityRepository): Response
    {
        $activities = $activityRepository->findBy([], ['name' =>'DESC']); //sort Z to A

        return $this->render(
            'activity/index.html.twig',
            ['activities' => $activities]
        );
    }
}
