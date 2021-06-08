<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Activity;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        $activities = $this->getDoctrine()
            ->getRepository(Activity::class)
            ->findBy(['isFeatured' => 'true'], ['name' => 'ASC'], 6);

        return $this->render('home/index.html.twig', ['activities' => $activities]);
    }
}
