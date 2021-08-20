<?php

namespace App\DataFixtures;

use App\Entity\SpaceCategory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

class SpaceCategoryFixtures extends Fixture implements FixtureGroupInterface
{
    public const SPACE_CATEGORIES = [
        [
            'name' => 'En salle',
            'description' => 'Des infrastructures de qualité et une large gamme d\'équipements en accès libre.',
            'photo' => 'https://bit.ly/3cpnieI',
        ],
        [
            'name' => 'En extérieur',
            'description' => 'Vous avez envie de faire du sport en plein air? Optez pour le coaching en extérieur.',
            'photo' => 'https://bit.ly/3wo6ooB',
        ],
        [
            'name' => 'En visio',
            'description' => 'Des cours de sport en ligne et en groupe, le tout supervisé par un coach certifié',
            'photo' => 'https://bit.ly/3xebK64',
        ]
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::SPACE_CATEGORIES as $index => $spaceCategoryDetails) {
            $spaceCategory = new SpaceCategory();
            $spaceCategory->setName($spaceCategoryDetails['name']);
            $spaceCategory->setDescription($spaceCategoryDetails['description']);
            $spaceCategory->setPhoto($spaceCategoryDetails['photo']);
            $manager->persist($spaceCategory);
            $this->addReference('space_category' . $index, $spaceCategory);
        }
        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['trainingspace'];
    }
}
