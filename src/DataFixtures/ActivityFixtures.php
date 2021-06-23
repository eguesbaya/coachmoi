<?php

namespace App\DataFixtures;

use App\Entity\Activity;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

class ActivityFixtures extends Fixture implements FixtureGroupInterface
{
    public const MAX_ACTIVITY = 10;
    public const FEATURED_ACTIVITY = [
        'Yoga',
        'Boxe',
        'Judo',
        'Salsa',
        'Escalade',
        'Remise en forme',
    ];

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i <= self::MAX_ACTIVITY; $i++) {
            $activity = new Activity();
            $activity->setName('Activité ' . $i);
            $activity->setIsFeatured(false);
            $activity->setDescription('Une description de l\'activité ' . $i);
            $activity->setPhoto('https://bit.ly/3gwemH4');

            $manager->persist($activity);
            $this->addReference('activity_' . $i, $activity);
        }

        foreach (self::FEATURED_ACTIVITY as $activityName) {
            $activity = new Activity();
            $activity->setName($activityName);
            $activity->setIsFeatured(true);
            $manager->persist($activity);
            $this->addReference('activity_' . $activityName, $activity);
        }

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['group1'];
    }
}
