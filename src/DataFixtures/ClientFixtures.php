<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Client;
use App\Entity\PracticeLevel;
use App\DataFixtures\UserFixtures;
use App\DataFixtures\ActivityFixtures;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\PracticeLevelFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ClientFixtures extends Fixture implements DependentFixtureInterface, FixtureGroupInterface
{

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        for ($i = 0; $i < UserFixtures::MAX_USERS / 3; $i++) {
            $client = new Client();
            $client->setUser($this->getReference('user_' . $i, $client));
            $client->setBirthdate($faker->dateTimeThisCentury());
            $client->setAddress($faker->address());
            $client->setBudget(rand(100, 500));
            $client->setGroupSize(rand(1, 5));
            $client->isApt(boolval(rand(0, 1)));
            $client->setGoal($faker->sentences(3, true));
            foreach (ActivityFixtures::FEATURED_ACTIVITY as $activityName) {
                $client->setActivity($this->getReference('activity_' . strtolower($activityName)));
            }
            for ($i = 0; $i < count(PracticeLevelFixtures::LEVELS) - 1; $i++) {
                $client->setPracticeLevel($this->getReference('level_' . $i));
            }


            $manager->persist($client);
            $this->addReference('client_' . $i, $client);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            ActivityFixtures::class,
            PracticeLevelFixtures::class
        ];
    }

    public static function getGroups(): array
    {
        return ['group1'];
    }
}
