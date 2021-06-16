<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Client;
use App\DataFixtures\UserFixtures;
use Doctrine\Persistence\ObjectManager;
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
            $client->setBirthdate($faker->dateTimeThisCentury());
            $client->setAddress($faker->address());
            $client->setBudget(rand(100, 500));
            $client->setGroupSize(rand(1, 5));
            $client->isApt(boolval(rand(0, 1)));
            $client->setUser($this->getRereference('user_' . $i, $client));

            $manager->persist($client);
            $client->addReference('client_' . $i);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }

    public static function getGroups(): array
    {
        return ['group1'];
    }
}
