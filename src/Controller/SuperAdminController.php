<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Coach;
use App\Form\EditUserType;
use App\Entity\SearchCoach;
use App\Entity\SearchClient;
use App\Form\SearchCoachType;
use App\Form\SearchClientType;
use App\Repository\UserRepository;
use App\Repository\CoachRepository;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
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
    public function showCoachs(CoachRepository $coachRepository, Request $request): Response
    {
        $searchCoach = new SearchCoach();
        $form = $this->createForm(SearchCoachType::class, $searchCoach);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $coachs = $coachRepository->findBySearch($searchCoach);
        }
        return $this->render('super_admin/show_coachs.html.twig', [
            'coachs' => $coachs ??  $coachRepository->findAll(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/clients", name="show_clients")
     */
    public function showClient(ClientRepository $clientRepository, Request $request): Response
    {
        $searchClient = new SearchClient();
        $form = $this->createForm(SearchClientType::class, $searchClient);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $clients = $clientRepository->findBySearch($searchClient);
        }

        return $this->render('super_admin/show_clients.html.twig', [
            'clients' => $clients ??  $clientRepository->findAll(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/users", name="show_users")
     */
    public function showUser(UserRepository $users): Response
    {
        return $this->render('super_admin/show_users.html.twig', [
            'users' => $users->findAll(),
        ]);
    }

    /**
     * @Route("/users/edit/{id}", name="edit_user")
     */
    public function editUser(User $user, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EditUserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newRole = $form->get('roles')->getData();

            //Si le ROLE_COACH est attribué
            if ($newRole == 'ROLE_COACH') {
                //Si le User a déjà le ROLE_COACH, je retourne un message d'erreur
                if (is_null($user->getCoach())) {
                    $coach = new Coach();
                    $user->setCoach($coach);
                    $entityManager->persist($coach);
                }
            }

            $user->setRoles([$newRole]);
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', $form->get('roles')->getData() . ' a bien été attribué à cet utilisateur ');

            return $this->redirectToRoute('superadmin_show_users');
        }
        return $this->render('super_admin/edit_user.html.twig', [
            'userForm' => $form->createView(),
        ]);
    }
}
