<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\UserRepository;
use App\Repository\ClientRepository;
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
}
