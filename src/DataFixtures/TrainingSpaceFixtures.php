<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\TrainingSpace;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class TrainingSpaceFixtures extends Fixture implements DependentFixtureInterface, FixtureGroupInterface
{
    public const TRAINING_SPACE = [
        [
            'name' => 'GIGAFIT ORLEANS SUD',
            'address' => '30 Rue Gustave Flaubert 45100 Orléans',
            'space_category' => '0',
            'photo' => 'https://bit.ly/3ecptDf',
        ],
        [
            'name' => 'GIGAFIT ORLEANS CENTRE',
            'address' => '12 Rue Royal 45000 Orléans',
            'space_category' => '0',
            'photo' => 'https://bit.ly/36yMf3Y',
        ],
        [
            'name' => 'GIGAFIT PARIS',
            'address' => 'Place du Châtelet 75000 Paris',
            'space_category' => '0',
            'photo' => 'https://bit.ly/3hAeYvH',
        ],
        [
            'name' => 'GIGAFIT TOURS',
            'address' => '30 Rue Gustave Flaubert 37000 Tours',
            'space_category' => '0',
            'photo' => 'https://bit.ly/2VATPZR',
        ],
        [
            'name' => 'GIGAFIT TOULOUSE',
            'address' => '7 Rue Bellegarde 31000 Orléans',
            'space_category' => '0',
            'photo' => 'https://bit.ly/3AP5dS1',
        ],
    ];

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        foreach (self::TRAINING_SPACE as $key => $trainingSpaceDetails) {
            $trainingSpaces = new TrainingSpace();
            $photo = $faker->image('public/uploads/training_spaces', 640, 480, 'training space', false, true, null, false);
            $trainingSpaces->setPhoto($photo);
            $trainingSpaces->addActivity($this->getReference('activity_' .
                rand(0, count(ActivityFixtures::ACTIVITY) - 1)));
            $trainingSpaces->setName($trainingSpaceDetails['name']);
            $trainingSpaces->setAddress($trainingSpaceDetails['address']);
            $trainingSpaces->setSpaceCategory($this->getReference('space_category0'));
            $manager->persist($trainingSpaces);
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

    public static function getGroups(): array
    {
        return ['trainingspace', 'booking'];
    }
}
