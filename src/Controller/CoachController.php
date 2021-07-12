<?php

namespace App\Controller;

use App\Entity\Coach;
use App\Repository\CoachRepository;
use App\Entity\SearchCoach;
use App\Form\SearchActivityType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/coachs", name="coachs_")
 */
class CoachController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(CoachRepository $coachRepository, Request $request): Response
    {
        $searchCoach = new SearchCoach();
        $form = $this->createForm(SearchActivityType::class, $searchCoach);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $coachs = $coachRepository->findBySearch($searchCoach);
        }

        return $this->render('coach/index.html.twig', [
            'coachs' => $coachs ??  $coachRepository->findAll(),
            'form' => $form->createView(),
        ]);
    }
}
