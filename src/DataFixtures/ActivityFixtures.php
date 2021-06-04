<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Activity;

class ActivityFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 50; $i++) {
            $activity = new Activity();
            $activity->setName('Activité ' . $i);
            $activity->setDescription('Une description de l\'activité ' . $i);

            $manager->persist($activity);
        }

        $manager->flush();
    }
}
