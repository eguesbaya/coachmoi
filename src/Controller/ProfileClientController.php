<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Client;
use App\Form\ClientType;
use App\Entity\Availability;
use App\Entity\CoachBooking;
use App\Repository\UserRepository;
use App\Form\ClientAvailabilityType;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AvailabilityRepository;
use App\Repository\BookingStatusRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @IsGranted("ROLE_CLIENT")
 */


class ProfileClientController extends AbstractController
{
    /**
     * @Route("/profil/client", name="profile_client")
     */
    public function index(): Response
    {
        return $this->render('profile_client/index.html.twig');
    }

    /**
     * @Route("/profil/client/editer", name="client_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, EntityManagerInterface $emi, BookingStatusRepository $statusRepo): Response
    {
        /** @var User */
        $user = $this->getUser();
        $client = $user->getClient() ?? new Client();
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //---WHY IS THIS NECESSARY?---
            // $client->setUser($user);
            // $emi->persist($client);

            //Si le client n'est pas encore relié à un coachBooking:
            // a new coachbooking row is created only if it doesn't exist yet AND the client's activity is not selected
            // Because coachbooking is created at the moment the client chooses his activity)
            if (is_null($client->getCoachBooking()) && is_null($client->getActivity())) {
                    //On créé un nouveau coachBooking...
                $coachBooking = new CoachBooking();
                //... que l'on lie au client
                $coachBooking->setClient($client);
                // On lui attribue le statut "A faire"
                $toDoStatus = $statusRepo->findOneBy(['status' => 'À faire']);
                $coachBooking->setBookingStatus($toDoStatus);
                //... puis on attribue ce nouveau coachBooking au client
                $client->setCoachBooking($coachBooking);

                $emi->persist($coachBooking);
            }

            $emi->flush();
            $this->addFlash(
                'success',
                'Vos informations ont bien été modifiées. Nous vous contacterons prochainement.'
            );

            return $this->redirectToRoute('profile_client');
        }

        return $this->render('profile_client/edit.html.twig', [
            'formClient' => $form->createView(),
        ]);
    }
    /**
     * @Route("/profil/client/disponibilite", name="client_availability_index", methods={"GET"})
     */
    public function indexAvailability(AvailabilityRepository $availabilites): Response
    {
        return $this->render('profile_client_availability/index.html.twig', [
            'availabilites' => $availabilites,
        ]);
    }

    /**
     * @Route("/profil/client/disponibilite/nouveau", name="client_availability_new", methods={"GET","POST"})
     */
    public function newAvailability(Request $request): Response
    {
        $availability = new Availability();

        $form = $this->createForm(ClientAvailabilityType::class, $availability);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            /** @var User */
            $user = $this->getUser();
            $availability->setClient($user->getClient());
            $entityManager->persist($availability);
            $entityManager->flush();
            $this->addFlash('success', 'Nouvelle disponibilité ajoutée');

            return $this->redirectToRoute('client_availability_index');
        }

        return $this->render('profile_client_availability/new.html.twig', [
            'availability' => $availability,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/profil/client/disponibilite/{id}/editer", name="client_availability_edit", methods={"GET","POST"})
     */
    public function editAvailability(Request $request, Availability $availability): Response
    {
        $form =  $this->createForm(ClientAvailabilityType::class, $availability);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Disponibilité modifiée');

            return $this->redirectToRoute('client_availability_index');
        }

        return $this->render('profile_client_availability/edit.html.twig', [
            'availability' => $availability,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/profil/client/disponibilite/{id}", name="client_availability_delete", methods={"POST"})
     */
    public function deleteAvailability(Request $request, Availability $availability): Response
    {
        if ($this->isCsrfTokenValid('delete' . $availability->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($availability);
            $entityManager->flush();
            $this->addFlash('success', 'Disponibilité supprimée');
        }

        return $this->redirectToRoute('client_availability_index');
    }
}
