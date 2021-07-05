<?php

namespace App\Controller;

use App\Entity\CoachBooking;
use App\Form\CoachBookingType;
use App\Repository\CoachBookingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/demandes")
 */
class CoachBookingController extends AbstractController
{
    /**
     * @Route("/", name="coach_booking_index", methods={"GET"})
     */
    public function index(CoachBookingRepository $coachBookingRepo): Response
    {
        return $this->render('coach_booking/index.html.twig', [
            'coach_bookings' => $coachBookingRepo->findAll(),
        ]);
    }
}
