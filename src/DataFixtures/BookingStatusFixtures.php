<?php

namespace App\DataFixtures;

use App\Entity\BookingStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BookingStatusFixtures extends Fixture
{
    public const STATUS = ['A faire', 'En cours', 'Réalisé', 'Annulé'];

    public function load(ObjectManager $manager)
    {
        foreach (self::STATUS as $index => $detail) {
            $status = new BookingStatus();
            $status->setStatus($detail);
            $manager->persist($status);
            $this->addReference('status_' . $index, $status);
        }

        $manager->flush();
    }
}
