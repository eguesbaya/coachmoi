<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Activity;

class ActivityFixtures extends Fixture
{
    private const MAX_ACTIVITY = 10;
    private const FEATURED_ACTIVITY = [
        'Yoga',
        'Boxe',
        'Judo',
        'Salsa',
        'Escalade',
        'Remise en forme',
    ];

    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= self::MAX_ACTIVITY; $i++) {
            $activity = new Activity();
            $activity->setName('Activité ' . $i);
            $activity->setIsFeatured(false);
            $activity->setDescription('Une description de l\'activité ' . $i);
            $activity->setPhoto('https: //bit.ly/3gwemH4');

            $manager->persist($activity);
        }

        foreach (self::FEATURED_ACTIVITY as $activityName) {
            $activity = new Activity();
            $activity->setName($activityName);
            $activity->setIsFeatured(true);
            $manager->persist($activity);
        }

        $manager->flush();
    }
}
