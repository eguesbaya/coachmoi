<?php

namespace App\Controller;

use App\Entity\CoachBooking;
use App\Entity\Client;
use App\Entity\Activity;
use App\Entity\Coach;
use App\Repository\CoachBookingRepository;
use App\Repository\TrainingSpaceRepository;
use App\Repository\CoachRepository;
use App\Repository\BookingStatusRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/superadmin/demandes")
 * @isGranted("ROLE_SUPERADMIN")
 */
class CoachBookingController extends AbstractController
{
    /**
     * @Route("/", name="coach_booking_index", methods={"GET"})
     * @isGranted("ROLE_SUPERADMIN")
     */
    public function index(CoachBookingRepository $coachBookingRepo, BookingStatusRepository $statusRepo): Response
    {
        return $this->render('coach_booking/index.html.twig', [
            'coach_bookings' => $coachBookingRepo->findAll(),
            'bookingStatus' => $statusRepo->findAll(),
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

    /**
    * @Route("/{id}/{activity_id}/coachs", name="show_coachs_byActivity", methods={"GET", "POST"}))
    * @ParamConverter("activity", class="App\Entity\Activity", options={"mapping": {"activity_id": "id"}})
    */
    public function showCoachByAct(CoachBooking $booking, Activity $activity, CoachRepository $coachRepo): Response
    {
        $coachs = $coachRepo->myFindByActivity($activity);

        return $this->render('coach_booking/list_availablecoachs.html.twig', [
            'coachs' => $coachs,
            'activity' => $activity,
            'coach_booking' => $booking,
        ]);
    }

    /**
    * @Route("/{id}/{activity_id}/espaces", name="show_spaces_byActivity", methods={"GET", "POST"}))
    * @ParamConverter("activity", class="App\Entity\Activity", options={"mapping": {"activity_id": "id"}})
    */
    public function showSpaceByAct(CoachBooking $book, Activity $activity, TrainingSpaceRepository $spaceRepo): Response
    {
        $spaces = $spaceRepo->myFindByActivity($activity);

        return $this->render('coach_booking/list_spaces.html.twig', [
            'spaces' => $spaces,
            'activity' => $activity,
            'coach_booking' => $book,
        ]);
    }

    /**
     * @Route("/add-coach/{id}/", name="cb_update_coach", methods={"POST"})
     */
    public function updateCoach(Request $request, CoachBooking $booking, CoachRepository $coachRepo): Response
    {
        if ($this->isCsrfTokenValid('cb_update_coach' . $booking->getId(), $request->request->get('_token'))) {
            $coach = $coachRepo->find($request->request->get('coach'));
            $booking->setCoach($coach);
            $this->getDoctrine()->getManager()->flush();
        }

        return $this->redirectToRoute('coach_booking_show', [
        'id' => $booking->getId(),
        ]);
    }

    /**
     * @Route("/add-space/{id}/", name="cb_update_space", methods={"POST"})
     */
    public function updateSpace(Request $request, CoachBooking $booking, TrainingSpaceRepository $spaceRepo): Response
    {
        if ($this->isCsrfTokenValid('cb_update_space' . $booking->getId(), $request->request->get('_token'))) {
            $space = $spaceRepo->find($request->request->get('trainingSpace'));
            $booking->setTrainingSpace($space);
            $this->getDoctrine()->getManager()->flush();
        }

        return $this->redirectToRoute('coach_booking_show', [
        'id' => $booking->getId(),
        ]);
    }

    /**
     * @Route("/update-status/{id}", name="cb_update_status", methods={"POST"})
     */
    public function updateStatus(Request $request, CoachBooking $booking, BookingStatusRepository $statusRepo): Response
    {
        if ($this->isCsrfTokenValid('cb_update_status' . $booking->getId(), $request->request->get('_token'))) {
            $status = $statusRepo->find($request->request->get('bookingStatus'));
            $booking->setBookingStatus($status);
            $this->getDoctrine()->getManager()->flush();
        }

        return $this->redirectToRoute('coach_booking_index');
    }
}
