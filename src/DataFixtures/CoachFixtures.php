<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Coach;
use App\DataFixtures\UserFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Validator\Constraints\DateTime;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CoachFixtures extends Fixture implements DependentFixtureInterface
{
    public const MAX_COACH = UserFixtures::MAX_USERS;
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        // Random Coaches linked to random Coach Users
        for ($i = 0; $i < self::MAX_COACH; $i++) {
            $coach = new Coach();
            $coach->setBirthdate($faker->dateTimeThisCentury());
            $coach->setHasVehicle($faker->boolean());
            $coach->setQualification($faker->word());
            $coach->setEquipment($faker->sentence());
            $coach->setBiography($faker->paragraph());
            $coach->setHourlyRate($faker->numberBetween(5, 100));
            $coach->setUser($this->getReference('user_coach_' . $i));
            $coach->addActivity($this->getReference('activity_' .
                rand(0, count(ActivityFixtures::FEATURED_ACTIVITY) - 1)));

            $manager->persist($coach);
            $this->addReference('coach_' . $i, $coach);
        }

        //Coach for Demo (linked to Coach Demo User)
        $coach = new Coach();
        $coach->setBirthdate($faker->dateTimeThisCentury());
        $coach->setHasVehicle($faker->boolean());
        $coach->setQualification('BP');
        $coach->setEquipment('tapis, haltères et medecine ball');
        $coach->setHourlyRate(25);
        // Replaced the function rand() by the id of the user to avoid the error of duplicated user ids
        $coach->setUser($this->getReference('demo_coach'));
        $coach->addActivity($this->getReference('activity_0'));
        $coach->setBiography('Jeune coach orléanais, je suis attentif à mes clients et m\'adapte à leur  psychologie afin de les pousser à donner le meilleur d\'eux-mêmes!');
        for ($i = 0; $i < CoachBookingFixtures::MAX_BOOKINGS; $i++) {
            $coach->addCoachBooking($this->getReference('booking_' . $i));
        }
        $manager->persist($coach);
        $this->addReference('coach', $coach);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            CoachBookingFixtures::class,
            ActivityFixtures::class
        ];
    }
}
