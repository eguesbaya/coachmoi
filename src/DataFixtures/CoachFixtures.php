<?php

namespace App\DataFixtures;

use App\Entity\Coach;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Validator\Constraints\DateTime;

class CoachFixtures extends Fixture implements DependentFixtureInterface
{
    private const MAX_COACH = 4;
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= self::MAX_COACH; $i++) {
            $coach = new Coach();
            $coach->setBirthdate(\DateTime::createFromFormat('Y-m-d', "1998-01-01"));
            $coach->setHasVehicle(true);
            $coach->setQualification('BP');
            $coach->setEquipment('Haltères, Corde à sauter, tapis');
            $coach->setBiography('Jeune coach spécialiste en remise en forme');
            $coach->setHourlyRate(50);
            // Replaced the function rand() by the id of the user to avoid the error of duplicated user ids
            $coach->setUser($this->getReference('user' . $i));
            $manager->persist($coach);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}
