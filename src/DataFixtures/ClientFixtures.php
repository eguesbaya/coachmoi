<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Client;
use App\DataFixtures\UserFixtures;
use App\DataFixtures\ActivityFixtures;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\PracticeLevelFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ClientFixtures extends Fixture implements DependentFixtureInterface, FixtureGroupInterface
{

    public const MAX_CLIENTS = UserFixtures::MAX_USERS;
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < self::MAX_CLIENTS; $i++) {
            $client = new Client();
            $client->setUser($this->getReference('user_client_' . $i, $client));
            $client->setAddress($faker->address());
            $client->setCreatedAt($faker->dateTimeThisCentury());
            $client->setBirthdate($faker->dateTimeThisCentury());
            $client->setGoal($faker->sentence(3));
            $client->setBudget($faker->numberBetween(50, 200));
            $client->setGroupSize($faker->randomDigit());
            $client->setIsApt(rand(0, 1));
            /*$client->setPracticeLevel($this->getReference(
                rand(0, count(PracticeLevelFixtures::LEVELS) - 1)
            ));
            $client->setActivity($this->getReference('activity_' .
                rand(0, count(ActivityFixtures::FEATURED_ACTIVITY) - 1)));*/
            $manager->persist($client);
            $this->addReference('client_' . $i, $client);
        }

        //Client for Demo
        $client = new Client();
        $client->setUser($this->getReference('demo_client'));
        $client->setBirthdate($faker->dateTimeThisCentury());
        $client->setAddress($faker->address());
        $client->setCreatedAt($faker->dateTimeThisCentury());
        $client->setGoal($faker->sentence(3));
        $client->setBudget($faker->numberBetween(50, 200));
        $client->setGroupSize($faker->randomDigit());
        $client->setIsApt(rand(0, 1));
        /*$client->setPracticeLevel($this->getReference(
            rand(0, count(PracticeLevelFixtures::LEVELS) - 1)
        ));
        $client->setActivity($this->getReference('activity_' .
                rand(0, count(ActivityFixtures::FEATURED_ACTIVITY) - 1)));*/
        $manager->persist($client);
        $this->addReference('client', $client);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            ActivityFixtures::class,
        ];
    }

    public static function getGroups(): array
    {
        return ['client', 'booking'];
    }
}
