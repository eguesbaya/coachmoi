<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\UserRepository;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
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
     * @Route("/profile/client", name="profile_client")
     */
    public function index(): Response
    {
        return $this->render('profile_client/index.html.twig');
    }

    /**
     * @Route("/profile/client/edit", name="client_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, EntityManagerInterface $entityManager): Response
    {
        /** @var User */
        $user = $this->getUser();
        $client = $user->getClient() ?? new Client();
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $client->setUser($user);
            $entityManager->persist($client);

            $entityManager->flush();

            return $this->redirectToRoute('profile_client');
        }

        return $this->render('profile_client/edit.html.twig', [
            'formClient' => $form->createView(),
        ]);
    }
}
