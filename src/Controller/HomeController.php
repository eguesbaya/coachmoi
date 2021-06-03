<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        /* fake table, remove once db is created*/
        $activities = [
            ['name' => 'Yoga', 'description' => 'On respire'],
            ['name' => 'Remise en forme', 'description' => 'Allez courage'],
            ['name' => 'Escalade', 'description' => 'Regarde pas en bas!'],
            ['name' => 'Salsa', 'description' => 'Bailemos'],
            ['name' => 'Judo', 'description' => 'Ceinture noire'],
            ['name' => 'Boxe', 'description' => 'Flot like a butterfly, sting like a bee'],
        ];

        return $this->render('home/index.html.twig', ['activities' => $activities]);
    }
}
