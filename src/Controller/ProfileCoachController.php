<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Entity\Coach;
use App\Entity\User;
use App\Form\CoachType;
use App\Repository\CoachRepository;
use Symfony\Component\HttpFoundation\Request;

/**
* @IsGranted("ROLE_COACH")
*/

class ProfileCoachController extends AbstractController
{
    /**
     * @Route("/profile/coach", name="profile_coach")
     */
    public function index(CoachRepository $coach): Response
    {
        return $this->render('profile_coach/index.html.twig', [
            'coach' => $coach->findOneBy([]),
        ]);
    }


    /**
     * @Route("/profile/coach/new", name="edit_coach_new", methods={"GET","POST"})
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
     * @Route("/profile/coach/edit", name="coach_edit", methods={"GET","POST"})
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
}
