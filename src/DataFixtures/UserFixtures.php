<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public const MAX_USERS = 10;

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i <= self::MAX_USERS; $i++) {
            $user = new User();
            $user->setFirstname('Prénom ' . $i);
            $user->setLastname('Nom ' . $i);
            $user->setTelephone('020304050' . $i);
            $user->setEmail('emailn' . $i . '@gmail.com');
            $this->addReference('user' . $i, $user);
            $manager->persist($user);
        }
        $manager->flush();
    }
}
