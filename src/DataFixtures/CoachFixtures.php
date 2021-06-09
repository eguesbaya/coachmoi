<?php

namespace App\DataFixtures;

use App\Entity\Coach;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CoachFixtures extends Fixture implements DependentFixtureInterface
{
    private const MAX_COACH = 4;
    public function load(ObjectManager $manager)
    {
        $birthday = "1998-01-01";
        for ($i = 1; $i <= self::MAX_COACH; $i++) {
            $coach = new Coach;
            $coach->setBirthdate(new \DateTime($birthday));
            $coach->setHasVehicle(true);
            $coach->setQualification('BP');
            $coach->setEquipment('Haltères, Corde à sauter, tapis');
            $coach->setBiography('Jeune coach spécialiste en remise en forme');
            $coach->setHourlyRate(50);
            $coach->setUser($this->getReference('user' . rand(1, UserFixtures::MAX_USERS)));
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
