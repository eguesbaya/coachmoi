<?php

namespace App\DataFixtures;

use App\Entity\TrainingSpace;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class TrainingSpaceFixtures extends Fixture implements DependentFixtureInterface
{
    public const TRAINING_SPACE = [
        [
            'name' => 'GIGAFIT ORLEANS SUD',
            'address' => '30 Rue Gustave Flaubert 45100 Orléans',
            'space_category' => '0',
        ],
        [
            'name' => 'GIGAFIT ORLEANS CENTRE',
            'address' => '12 Rue Royal 45000 Orléans',
            'space_category' => '0',
        ],
        [
            'name' => 'GIGAFIT PARIS',
            'address' => 'Place du Châtelet 75000 Paris',
            'space_category' => '0',
        ],
        [
            'name' => 'GIGAFIT TOURS',
            'address' => '30 Rue Gustave Flaubert 37000 Tours',
            'space_category' => '0',
        ],
        [
            'name' => 'GIGAFIT TOULOUSE',
            'address' => '7 Rue Bellegarde 31000 Orléans',
            'space_category' => '0',
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::TRAINING_SPACE as $key => $trainingSpaceDetails) {
            $trainingSpaces = new TrainingSpace();
            $trainingSpaces->addActivity($this->getReference('activity_' .
                rand(0, count(ActivityFixtures::FEATURED_ACTIVITY) - 1)));
            $manager->persist($trainingSpaces);
            $trainingSpaces->setName($trainingSpaceDetails['name']);
            $trainingSpaces->setAddress($trainingSpaceDetails['address']);
            $trainingSpaces->setSpaceCategory($this->getReference('space_category0'));
            $this->addReference('training_space_' . $key, $trainingSpaces);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            SpaceCategoryFixtures::class,
            ActivityFixtures::class
        ];
    }
}
