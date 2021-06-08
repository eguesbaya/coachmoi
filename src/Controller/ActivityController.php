<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActivityController extends AbstractController
{
    /**
     * @Route("/activity", name="activity")
     */
    public function index(): Response
    {
        //$activities = $this->getDoctrine()
            //->getRepository(Activity::class)
            //->findAll();

        return $this->render('activity/index.html.twig');
    }
}
