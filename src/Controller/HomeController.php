<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Coach;
use App\Repository\CoachRepository;
use App\Entity\Activity;
use App\Repository\ActivityRepository;
use App\Repository\SpaceCategoryRepository;

class HomeController extends AbstractController
{

    private const MAX_ACTIVITY = 6;
    private const MAX_COACHS = 4;
    /**
     * @Route("/", name="home")
     */
    public function index(
        ActivityRepository $activityRepository,
        SpaceCategoryRepository $spaceCategoryRepo,
        CoachRepository $coachRepository
    ): Response {
        $activities = $activityRepository
            ->findBy(['isFeatured' => 'true'], ['name' => 'ASC'], self::MAX_ACTIVITY);
        $coachs = $coachRepository
            ->findBy([], ['id' => 'ASC'], self::MAX_COACHS);

        return $this->render('home/index.html.twig', [
            'activities' => $activities,
            'space_categories' => $spaceCategoryRepo->findAll(),
            'coachs' => $coachs,
            ]);
    }
}
