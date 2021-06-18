<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Activity;

class ActivityFixtures extends Fixture
{
    public const MAX_ACTIVITY = 10;
    public const FEATURED_ACTIVITY = [
        ['name' => 'Yoga', 'photo' => 'https://bit.ly/3gxCuJg'],
        ['name' => 'Boxe', 'photo' => 'https://bit.ly/3iQ76az'],
        ['name' => 'Judo', 'photo' => 'https://bit.ly/3gwemH4'],
        ['name' => 'Escalade', 'photo' => 'https://bit.ly/2SIqI5F'],
        ['name' => 'Remise en forme','photo' => 'https://bit.ly/3wEnA9M']
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
        }

        foreach (self::FEATURED_ACTIVITY as $key => $data) {
            $activity = new Activity();
            $activity->setName($data['name']);
            $activity->setPhoto($data['photo']);
            $activity->setIsFeatured(true);
            $manager->persist($activity);
            $this->addReference('activity_' . $key, $activity);
        }

        $manager->flush();
    }
}
