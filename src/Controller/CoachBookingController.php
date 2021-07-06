<?php

namespace App\Controller;

use App\Entity\CoachBooking;
use App\Repository\CoachBookingRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/demandes")
 * @isGranted("ROLE_SUPERADMIN")
 */
class CoachBookingController extends AbstractController
{
    /**
     * @Route("/", name="coach_booking_index", methods={"GET"})
     * @isGranted("ROLE_SUPERADMIN")
     */
    public function index(CoachBookingRepository $coachBookingRepo): Response
    {
        return $this->render('coach_booking/index.html.twig', [
            'coach_bookings' => $coachBookingRepo->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="coach_booking_show", methods={"GET", "POST"})
     */
    public function show(CoachBooking $coachBooking): Response
    {
        return $this->render('coach_booking/show.html.twig', [
            'coach_booking' => $coachBooking
        ]);
    }
}
