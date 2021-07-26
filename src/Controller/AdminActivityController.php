<?php

namespace App\Controller;

use App\Entity\Activity;
use App\Form\ActivityType;
use App\Repository\ActivityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/superadmin/activite")
 * @isGranted("ROLE_SUPERADMIN")
 */
class AdminActivityController extends AbstractController
{
    /**
     * @Route("/", name="admin_activity_index", methods={"GET"})
     */
    public function index(ActivityRepository $activityRepository): Response
    {
        return $this->render('admin_activity/index.html.twig', [
            'activities' => $activityRepository->findAll(),
        ]);
    }

    /**
     * @Route("/nouvelle", name="admin_activity_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $activity = new Activity();
        $form = $this->createForm(ActivityType::class, $activity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($activity);
            $entityManager->flush();

            return $this->redirectToRoute('admin_activity_index');
        }

        return $this->render('admin_activity/new.html.twig', [
            'activity' => $activity,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/editer", name="admin_activity_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Activity $activity): Response
    {
        $form = $this->createForm(ActivityType::class, $activity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_activity_index');
        }

        return $this->render('admin_activity/edit.html.twig', [
            'activity' => $activity,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_activity_delete", methods={"POST"})
     */
    public function delete(Request $request, Activity $activity): Response
    {
        $isClientEmpty = $activity->getClients()->isEmpty();
        $isCoachEmpty = $activity->getCoaches()->isEmpty();
        $isSpaceEmpty = $activity->getTrainingSpaces()->isEmpty();
        if ($isClientEmpty &&  $isCoachEmpty && $isSpaceEmpty) {
            if ($this->isCsrfTokenValid('delete' . $activity->getId(), $request->request->get('_token'))) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->remove($activity);
                $entityManager->flush();
                $this->addFlash('success', 'L\'activité a été supprimée avec succès.');
            }
        } else {
            $this->addFlash('danger', 'Vous ne pouvez pas supprimer cette activité.');
        }
        return $this->redirectToRoute('admin_activity_index');
    }
}
