<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Coach;
use App\Entity\Client;
use App\Entity\Activity;
use App\Repository\CoachRepository;
use App\Repository\ActivityRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\SpaceCategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{

    private const MAX_ACTIVITY = 6;
    private const MAX_COACHS = 4;
    /**
     * @Route("/", name="home")
     */
    public function index(
        ActivityRepository $activityRepository,
        SpaceCategoryRepository $spaceCategoryRepo,
        CoachRepository $coachRepository
    ): Response {
        $activities = $activityRepository
            ->findBy(['isFeatured' => 'true'], ['name' => 'ASC'], self::MAX_ACTIVITY);
        $coachs = $coachRepository
            ->findBy([], ['id' => 'ASC'], self::MAX_COACHS);

        return $this->render('home/index.html.twig', [
            'activities' => $activities,
            'space_categories' => $spaceCategoryRepo->findAll(),
            'coachs' => $coachs,
        ]);
    }


    /**
     * @Route("/choisir/cours/{activity}", name="choice_lesson", methods={"GET","POST"})
     */
    public function editActivity(Request $request, EntityManagerInterface $entityManager, Activity $activity): Response
    {
        /** @var User */
        $user = $this->getUser();

        if ( in_array('ROLE_CLIENT', $user->getRoles())) {
            /** @var Client */
            $client = $user->getClient();
            $client->setActivity($activity);
            $entityManager->persist($client);
        } elseif ( in_array('ROLE_COACH', $user->getRoles())) {
            /** @var Coach */
            $coach = $user->getCoach();
            $coach->addActivity($activity);
            $entityManager->persist($coach);
        }

        $entityManager->flush();

        $this->addFlash('message', 'votre modification a bien été prise en compte!');

        return $this->redirectToRoute('home');
    }
}
