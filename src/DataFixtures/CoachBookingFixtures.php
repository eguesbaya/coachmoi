<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\CoachBooking;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CoachBookingFixtures extends Fixture implements DependentFixtureInterface, FixtureGroupInterface
{
    public const MAX_BOOKINGS = 10;
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < self::MAX_BOOKINGS; $i++) {
            $booking = new CoachBooking();
            $booking->setClient($this->getReference('client_' . $i));
            $booking->setTrainingSpace($this->getReference(
                'training_space_' . rand(0, count(TrainingSpaceFixtures::TRAINING_SPACE) - 1)
            ));
            $booking->setCreatedAt($faker->dateTimeThisCentury());
            $booking->setBookingStatus($this->getReference('status_' .
            rand(0, count(BookingStatusFixtures::STATUS) - 1)));
            $manager->persist($booking);
            $this->addReference('booking_' . $i, $booking);
        }

        $booking = new CoachBooking();
        $booking->setClient($this->getReference('client_admin'));
        $booking->setTrainingSpace($this->getReference('training_space_0'));
        $booking->setCreatedAt($faker->dateTimeThisCentury());
        $booking->setBookingStatus($this->getReference('status_0'));
        $manager->persist($booking);
        $this->addReference('booking_demo', $booking);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ClientFixtures::class,
            TrainingSpaceFixtures::class,
            BookingStatusFixtures::class,
        ];
    }

    public static function getGroups(): array
    {
        return ['booking'];
    }
}
