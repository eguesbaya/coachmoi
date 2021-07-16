<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Coach;
use App\Form\CoachType;
use App\Entity\Availability;
use App\Form\CoachAvailabilityType;
use App\Repository\CoachRepository;
use App\Repository\AvailabilityRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
* @IsGranted("ROLE_COACH")
*/

class ProfileCoachController extends AbstractController
{
    /**
     * @Route("/profil/coach", name="profile_coach")
     */
    public function index(CoachRepository $coach): Response
    {
        return $this->render('profile_coach/index.html.twig', [
            'coach' => $coach->findOneBy([]),
        ]);
    }


    /**
     * @Route("/profil/coach/nouveau", name="edit_coach_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $coach = new Coach();
        $form = $this->createForm(CoachType::class, $coach);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($coach);
            $entityManager->flush();

            return $this->redirectToRoute('edit_coach_index');
        }

        return $this->render('profile_coach/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/profil/coach/editer", name="coach_edit", methods={"GET","POST"})
     */
    public function edit(Request $request): Response
    {
        /** @var User */
        $user = $this->getUser();
        $coach = $user->getCoach();
        $form = $this->createForm(CoachType::class, $coach);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('profile_coach');
        }

        return $this->render('profile_coach/edit.html.twig', [
            'formCoach' => $form->createView(),
        ]);
    }

    /**
     * @Route("/profil/coach/disponibilite", name="coach_availability_index", methods={"GET"})
     */
    public function indexAvailability(AvailabilityRepository $availabilites): Response
    {
        return $this->render('profile_coach_availability/index.html.twig', [
            'availabilites' => $availabilites,
        ]);
    }

    /**
     * @Route("/profil/coach/disponibilite/nouveau", name="coach_availability_new", methods={"GET","POST"})
     */
    public function newAvailability(Request $request): Response
    {
        $availability = new Availability();

        $form = $this->createForm(CoachAvailabilityType::class, $availability);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            /** @var User */
            $user = $this->getUser();
            $availability->setCoach($user->getCoach());
            $entityManager->persist($availability);
            $entityManager->flush();
            $this->addFlash('success', 'Nouvelle disponibilité ajouté');

            return $this->redirectToRoute('coach_availability_index');
        }

        return $this->render('profile_coach_availability/new.html.twig', [
            'availability' => $availability,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/profil/coach/disponibilite/{id}", name="coach_availability_show", methods={"GET"})
     */
    public function showAvailability(Availability $availability): Response
    {
        return $this->render('profile_coach_availability/show.html.twig', [
            'availability' => $availability,
        ]);
    }

    /**
     * @Route("/profil/coach/disponibilite/{id}/editer", name="coach_availability_edit", methods={"GET","POST"})
     */
    public function editAvailability(Request $request, Availability $availability): Response
    {
        $form =  $this->createForm(CoachAvailabilityType::class, $availability);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Disponibilité modifiée');

            return $this->redirectToRoute('coach_availability_index');
        }

        return $this->render('profile_coach_availability/edit.html.twig', [
            'availability' => $availability,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/profil/coach/disponibilite/{id}", name="coach_availability_delete", methods={"POST"})
     */
    public function deleteAvailability(Request $request, Availability $availability): Response
    {
        if ($this->isCsrfTokenValid('delete' . $availability->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($availability);
            $entityManager->flush();
            $this->addFlash('success', 'Disponibilité supprimée');
        }

        return $this->redirectToRoute('coach_availability_index');
    }
}
