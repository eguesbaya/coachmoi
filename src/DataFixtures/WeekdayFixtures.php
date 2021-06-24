<?php

namespace App\DataFixtures;

use App\Entity\Weekday;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class WeekdayFixtures extends Fixture
{
    public const WEEKDAYS = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];

    public function load(ObjectManager $manager)
    {
        foreach (self::WEEKDAYS as $index => $day) {
            $weekday = new Weekday();
            $weekday->setName($day);
            $manager->persist($weekday);
            $this->addReference('weekday' . $index, $weekday);
        }

        $manager->flush();
    }
}
