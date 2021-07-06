<?php

namespace App\DataFixtures;

use App\Entity\Availability;
use App\DataFixtures\WeekdayFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AvailabilityFixtures extends Fixture implements DependentFixtureInterface
{
    public const MAX_AVAILABILITY = 3;

    public function load(ObjectManager $manager)
    {
        for ($j = 0; $j < ClientFixtures::MAX_CLIENTS; $j++) {
            for ($i = 0; $i < self::MAX_AVAILABILITY; $i++) {
                $availability = new Availability();
                $availability->setStartTime(\DateTime::createFromFormat('H:i', "08:00"));
                $availability->setEndTime(\DateTime::createFromFormat('H:i', "09:00"));
                $availability->setWeekday($this->getReference('weekday' .
                    rand(0, count(WeekdayFixtures::WEEKDAYS) - 1)));
                $availability->setClient($this->getReference('client_' . $j));
                $manager->persist($availability);
            }
        }

        for ($j = 0; $j < CoachFixtures::MAX_COACH; $j++) {
            for ($i = 0; $i < self::MAX_AVAILABILITY; $i++) {
                $availability = new Availability();
                $availability->setStartTime(\DateTime::createFromFormat('H:i', "08:00"));
                $availability->setEndTime(\DateTime::createFromFormat('H:i', "09:00"));
                $availability->setWeekday($this->getReference('weekday' .
                    rand(0, count(WeekdayFixtures::WEEKDAYS) - 1)));
                $availability->setCoach($this->getReference('coach_' . $j));
                $manager->persist($availability);
            }
        }
        // Fixture for client's demo account: client@gmail.com
        $availability = new Availability();
        $availability->setStartTime(\DateTime::createFromFormat('H:i', "18:00"));
        $availability->setEndTime(\DateTime::createFromFormat('H:i', "19:00"));
        $availability->setWeekday($this->getReference('weekday1'));
        $availability->setClient($this->getReference('client_admin'));
        $manager->persist($availability);

        // Fixture for coach's demo account: coach@gmail.com
        $availability = new Availability();
        $availability->setStartTime(\DateTime::createFromFormat('H:i', "15:00"));
        $availability->setEndTime(\DateTime::createFromFormat('H:i', "20:00"));
        $availability->setWeekday($this->getReference('weekday1'));
        $availability->setCoach($this->getReference('coach_0'));
        $manager->persist($availability);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            WeekdayFixtures::class,
            ClientFixtures::class,
            CoachFixtures::class,
        ];
    }
}
