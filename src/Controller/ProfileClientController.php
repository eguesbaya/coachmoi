<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\User;
use App\Entity\Availability;
use App\Form\ClientType;
use App\Form\ClientAvailabilityType;
use App\Repository\UserRepository;
use App\Repository\ClientRepository;
use App\Repository\AvailabilityRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @IsGranted("ROLE_CLIENT")
 */


class ProfileClientController extends AbstractController
{
    /**
     * @Route("/profile/client", name="profile_client")
     */
    public function index(): Response
    {
        return $this->render('profile_client/index.html.twig');
    }

    /**
     * @Route("/profile/client/edit", name="client_edit", methods={"GET","POST"})
     */
    public function edit(Request $request): Response
    {
        /** @var User */
        $user = $this->getUser();
        $client = $user->getClient();
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('profile_client');
        }

        return $this->render('profile_client/edit.html.twig', [
            'formClient' => $form->createView(),
        ]);
    }
    /**
     * @Route("/availability", name="client_availability_index", methods={"GET"})
     */
    public function indexAvailability(AvailabilityRepository $availabilites): Response
    {
        return $this->render('profile_client_availability/index.html.twig', [
            'availabilites' => $availabilites,
        ]);
    }

    /**
     * @Route("/profile/client/availability/new", name="client_availability_new", methods={"GET","POST"})
     */
    public function newAvailability(Request $request): Response
    {
        $availability = new Availability();

        $form = $this->createForm(ClientAvailabilityType::class, $availability);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $availability->setClient($this->getUser()->$this->getClient());
            $entityManager->persist($availability);
            $entityManager->flush();
            $this->addFlash('success', 'Nouvelle disponibilité ajouté');

            return $this->redirectToRoute('client_availability_index');
        }

        return $this->render('profile_client_availability/new.html.twig', [
            'availability' => $availability,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/profile/client/availability/{id}", name="client_availability_show", methods={"GET"})
     */
    public function showAvailability(Availability $availability): Response
    {
        return $this->render('profile_client_availability/show.html.twig', [
            'availability' => $availability,
        ]);
    }

    /**
     * @Route("/profile/client/availability/{id}/edit", name="client_availability_edit", methods={"GET","POST"})
     */
    public function editAvailability(Request $request, AvailabilityRepository $availability): Response
    {
        $form =  $this->createForm(ClientAvailabilityType::class, $availability);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('client_availability_index');
        }

        return $this->render('profile_client_availability/edit.html.twig', [
            'availability' => $availability,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/profile/client/availability/{id}", name="client_availability_delete", methods={"POST"})
     */
    public function deleteAvailability(Request $request, Availability $availability): Response
    {
        if ($this->isCsrfTokenValid('delete' . $availability->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($availability);
            $entityManager->flush();
        }

        return $this->redirectToRoute('client_availability_index');
    }
}
