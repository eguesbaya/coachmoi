<?php

namespace App\DataFixtures;

use App\Entity\CoachBooking;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CoachBookingFixtures extends Fixture implements DependentFixtureInterface
{
    public const MAX_BOOKINGS = 10;
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < self::MAX_BOOKINGS; $i++) {
            $booking = new CoachBooking();
            $booking->setClient($this->getReference('client_' . $i));
            $manager->persist($booking);
            $this->addReference('booking_' . $i, $booking);
        }

        $booking = new CoachBooking();
        $booking->setCoach($this->getReference('coach_1'));
        $booking->setClient($this->getReference('client_admin'));
        $booking->setTrainingSpace($this->getReference('training_space_0'));
        $manager->persist($booking);
        $this->addReference('booking_demo', $booking);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ClientFixtures::class,
            TrainingSpaceFixtures::class,
        ];
    }
}
