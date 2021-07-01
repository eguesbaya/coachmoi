<?php

namespace App\DataFixtures;

use App\Entity\PracticeLevel;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class PracticeLevelFixtures extends Fixture
{
    public const LEVELS = [
        'débutant',
        'intermédiaire',
        'avancé',
        'pro'
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::LEVELS as $key => $level) {
           $practiceLevel = new PracticeLevel();
           $practiceLevel->setLevel($level);
           $manager->persist($practiceLevel);
           $this->addReference($key, $practiceLevel);
        }
        
        $manager->flush();
    }
}
