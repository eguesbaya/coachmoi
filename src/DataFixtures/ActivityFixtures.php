<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Activity;

class ActivityFixtures extends Fixture
{
    private const MAX_ACTIVITY_NB = 15;

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        for ($i = 1; $i <= self::MAX_ACTIVITY_NB; $i++) {
            $activity = new Activity();
            $activity->setName('Nom d\activité ' . $i);
            $activity->setDescription('Courte description de l\'activité ' . $i);
            $manager->persist($activity);
        }

        $manager->flush();
    }
}
