<?php

namespace App\DataFixtures;

use App\Entity\PracticeLevel;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class PracticeLevelFixtures extends Fixture implements FixtureGroupInterface
{
    public const LEVELS = [
        'Débutant',
        'Intermédiaire',
        'Avancé',
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::LEVELS as $key => $level) {
            $practiceLevel = new PracticeLevel();
            $practiceLevel->setLevel($level);
            $manager->persist($practiceLevel);
            $this->addReference('level_' . $key, $practiceLevel);
        }

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['group1'];
    }
}
