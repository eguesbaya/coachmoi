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


    /**
     * @Route("/{id}/edit", name="coach_booking_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CoachBooking $coachBooking): Response
    {
        $form = $this->createForm(CoachBookingType::class, $coachBooking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('coach_booking_index');
        }

        return $this->render('coach_booking/edit.html.twig', [
            'coach_booking' => $coachBooking,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="coach_booking_delete", methods={"POST"})
     */
    public function delete(Request $request, CoachBooking $coachBooking): Response
    {
        if ($this->isCsrfTokenValid('delete' . $coachBooking->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($coachBooking);
            $entityManager->flush();
        }

        return $this->redirectToRoute('coach_booking_index');
    }
}
