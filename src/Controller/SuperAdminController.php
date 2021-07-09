<?php

namespace App\Controller;

use App\Repository\CoachRepository;
use App\Repository\ClientRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/superadmin", name="superadmin_")
 * @isGranted("ROLE_SUPERADMIN")
 */
class SuperAdminController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        return $this->render('super_admin/index.html.twig', [
            'app_controller' => 'SuperAdminController',
        ]);
    }

    /**
     * @Route("/coachs", name="show_coachs")
     */
    public function showCoachs(CoachRepository $coachRepository): Response
    {
        return $this->render('super_admin/show_coachs.html.twig', [
            'coachs' => $coachRepository->findAll(),
        ]);
    }

    /**
     * @Route("/clients", name="show_clients")
     */
    public function showClient(ClientRepository $clientRepository): Response
    {
        return $this->render('super_admin/show_clients.html.twig', [
            'clients' => $clientRepository->findAll(),
        ]);
    }
}
