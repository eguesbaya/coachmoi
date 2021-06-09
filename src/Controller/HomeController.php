<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Coach;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        $coachs = $this->getDoctrine()
            ->getRepository(Coach::class)
            ->findAll();

        return $this->render('home/index.html.twig', [
            'coachs' => $coachs,
        ]);
    }
}
