<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Activity;

class ActivityFixtures extends Fixture
{
    private const MAX_ACTIVITY = 10;

    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= self::MAX_ACTIVITY; $i++) {
            $activity = new Activity();
            $activity->setName('Activité ' . $i);
            $activity->setDescription('Une description de l\'activité ' . $i);

            $manager->persist($activity);
        }

        $manager->flush();
    }
}
