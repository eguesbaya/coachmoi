<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Activity;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

class ActivityFixtures extends Fixture implements FixtureGroupInterface
{
    public const FEATURED_ACTIVITY = [
        [
            'name' => 'Perte de poids',
            'photo' => 'https://bit.ly/2VanXLb',
            'description' => 'Ton objectif est la perte de poids, C’est ici !'
        ],
        [
            'name' => 'Prise de masse',
            'photo' => 'https://bit.ly/3xnWB2m',
            'description' => 'Tu souhaites augmenter ta masse musculaire, c’est ici !'
        ],
        [
            'name' => 'Renforcement musculaire',
            'photo' => 'https://bit.ly/3qNr0EW',
            'description' => 'Tu souhaites faire évoluer ton corps pour
             le rendre plus résistant, plus mobile et plus fonctionnel, c’est ici !'
        ],
        [
            'name' => 'Performance sportive',
            'photo' => 'https://bit.ly/36iE3ER',
            'description' => 'Ton objectif est l’amélioration de tes performances sportives, 
            rejoins nos préparateurs physiques !'
        ],
        [
            'name' => 'Remise en forme',
            'photo' => 'https://bit.ly/3dTj7Zw',
            'description' => 'Tu souhaites reprendre une activité physique avec un accompagnement
             sur mesure ! C’est ici !'
        ],
        [
            'name' => 'Boxe thaï',
            'photo' => 'https://bit.ly/3wpo2rr',
            'description' => 'Tu veux apprendre ou améliorer ta boxe thaï, c’est ici !'
        ],
        [
            'name' => 'Boxe anglaise',
            'photo' => 'https://bit.ly/3jO7hDy',
            'description' => 'Tu veux apprendre ou améliorer ta boxe anglaise, c’est ici !'
        ],
        [
            'name' => 'jiu jitsu Grappling',
            'photo' => 'https://bit.ly/3wg5Q3j',
            'description' => 'Tu veux apprendre ou améliorer ton JJB ou ton Grappling, c’est ici !'
        ],
    ];

    public function load(ObjectManager $manager)
    {

        foreach (self::FEATURED_ACTIVITY as $key => $data) {
            $activity = new Activity();
            $activity->setName($data['name']);
            /*copy($data['photo'], "public/uploads/activities/activity" . $key . '.webp');*/
            /*$activity->setPhoto("activity" . $key . ".webp");*/
            $activity->setDescription($data['description']);
            $activity->setIsFeatured(true);
            $manager->persist($activity);
            $this->addReference('activity_' . $key, $activity);
        }

        $manager->flush();
    }

    public static function getGroups(): array
    {
         return ['client', 'trainingspace'];
    }
}
