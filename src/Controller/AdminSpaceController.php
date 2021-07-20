<?php

namespace App\Controller;

use App\Entity\TrainingSpace;
use App\Form\TrainingSpaceType;
use App\Repository\TrainingSpaceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/superadmin/espace")
 * @isGranted("ROLE_SUPERADMIN")
 */
class AdminSpaceController extends AbstractController
{
    /**
     * @Route("/", name="admin_space_index", methods={"GET"})
     */
    public function index(TrainingSpaceRepository $trainingSpaceRepo): Response
    {
        return $this->render('admin_space/index.html.twig', [
            'training_spaces' => $trainingSpaceRepo->findAll(),
        ]);
    }
    /**
     * @Route("/nouvelle", name="admin_space_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $trainingSpace = new TrainingSpace();
        $form = $this->createForm(TrainingSpaceType::class, $trainingSpace);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($trainingSpace);
            $entityManager->flush();

            return $this->redirectToRoute('admin_space_index');
        }

        return $this->render('admin_space/new.html.twig', [
            'training_space' => $trainingSpace,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_space_show", methods={"GET"})
     */
    public function show(TrainingSpace $trainingSpace): Response
    {
        return $this->render('admin_space/show.html.twig', [
            'training_space' => $trainingSpace,
        ]);
    }

    /**
     * @Route("/{id}/editer", name="admin_space_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TrainingSpace $trainingSpace): Response
    {
        $form = $this->createForm(TrainingSpaceType::class, $trainingSpace);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_space_index');
        }

        return $this->render('admin_space/edit.html.twig', [
            'training_space' => $trainingSpace,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_space_delete", methods={"POST"})
     */
    public function delete(Request $request, TrainingSpace $trainingSpace): Response
    {
        if ($this->isCsrfTokenValid('delete' . $trainingSpace->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($trainingSpace);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_space_index');
    }
}
