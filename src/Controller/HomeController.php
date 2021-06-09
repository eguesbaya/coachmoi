<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Activity;
use App\Repository\ActivityRepository;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ActivityRepository $activityRepository): Response
    {
        $activities = $activityRepository
            ->findBy(['isFeatured' => 'true'], ['name' => 'ASC'], 6);

        return $this->render('home/index.html.twig', ['activities' => $activities]);
    }
}
