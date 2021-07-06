<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Activity;

class ActivityFixtures extends Fixture
{
    public const FEATURED_ACTIVITY = [
        [
            'name' => 'Perte de poids',
            'photo' => 'https://bit.ly/3jTANbj',
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
            'photo' => 'https://bit.ly/3wEnA9M',
            'description' => 'Tu souhaites reprendre une activité physique avec un accompagnement
             sur mesure ! C’est ici !'
        ],
        [
            'name' => 'Boxe thaï',
            'photo' => 'https://bit.ly/3wmyno7',
            'description' => 'Tu veux apprendre ou améliorer ta boxe thaï, c’est ici !'
        ],
        [
            'name' => 'Boxe anglaise',
            'photo' => 'https://bit.ly/3jO7hDy',
            'description' => 'Tu veux apprendre ou améliorer ta boxe anglaise, c’est ici !'
        ],
        [
            'name' => 'jiu jitsu/Grappling',
            'photo' => 'https://bit.ly/3wg5Q3j',
            'description' => 'Tu veux apprendre ou améliorer ton JJB ou ton Grappling, c’est ici !'
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::FEATURED_ACTIVITY as $key => $data) {
            $activity = new Activity();
            $activity->setName($data['name']);
            $activity->setPhoto($data['photo']);
            $activity->setDescription($data['description']);
            $activity->setIsFeatured(true);
            $manager->persist($activity);
            $this->addReference('activity_' . $key, $activity);
        }

        $manager->flush();
    }
}
