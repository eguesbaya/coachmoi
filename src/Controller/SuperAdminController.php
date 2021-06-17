<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SuperAdminController extends AbstractController
{
    /**
     * @Route("/superadmin", name="superadmin")
     */
    public function index(): Response
    {
        return $this->render('super_admin/index.html.twig', [
            'superadmin' => 'Franck ;) ',
        ]);
    }
}
