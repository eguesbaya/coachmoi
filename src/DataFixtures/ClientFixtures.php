<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Client;
use App\DataFixtures\UserFixtures;
use App\DataFixtures\ActivityFixtures;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\PracticeLevelFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ClientFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < UserFixtures::MAX_USERS / 3; $i++) {
            $client = new Client();
            $client->setUser($this->getReference('user_' . $i, $client));
            $client->setBirthdate($faker->dateTimeThisCentury());
            $client->setAddress($faker->address());
            $client->setGoal($faker->sentence(3));
            $client->setBudget($faker->numberBetween(50, 200));
            $client->setGroupSize($faker->randomDigit());
            $client->setIsApt(rand(0, 1));
            $client->setPracticeLevel($this->getReference(
                rand(0, count(PracticeLevelFixtures::LEVELS) - 1)
            ));
            $manager->persist($client);
            $this->addReference('client_' . $i, $client);
        }

        // Client admin
        $client = new Client();
        $client->setUser($this->getReference('client'));
        $client->setBirthdate($faker->dateTimeThisCentury());
        $client->setAddress($faker->address());
        $client->setGoal($faker->sentence(3));
        $client->setBudget($faker->numberBetween(50, 200));
        $client->setGroupSize($faker->randomDigit());
        $client->setIsApt(rand(0, 1));
        $client->setPracticeLevel($this->getReference(
            rand(0, count(PracticeLevelFixtures::LEVELS) - 1)
        ));
        $manager->persist($client);
        $this->addReference('client_admin', $client);

        // New client test
        $client = new Client();
        $client->setUser($this->getReference('client_new', $client));
        $manager->persist($client);
        $this->addReference('new_client', $client);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}
