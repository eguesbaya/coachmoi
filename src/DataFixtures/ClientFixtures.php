<?php

namespace App\DataFixtures;

use App\DataFixtures\ActivityFixtures;
use App\DataFixtures\PracticeLevelFixtures;
use App\DataFixtures\UserFixtures;
use App\Entity\Client;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ClientFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {

        for ($i = 0; $i < UserFixtures::MAX_USERS / 3; $i++) {
            $client = new Client();
            $client->setUser($this->getReference('user_' . $i, $client));
            $manager->persist($client);
            $this->addReference('client_' . $i, $client);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}
