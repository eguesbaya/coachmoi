<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture implements FixtureGroupInterface
{
    public const MAX_USERS = 10;
    private $passwordEncoder;
    public const ROLES = [
        'ROLE_SUPERADMIN',
        'ROLE_COACH',
        'ROLE_CLIENT',
        'ROLE_USER'
    ];

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        //Random clients
        for ($i = 0; $i <= self::MAX_USERS; $i++) {
            $client = new User();
            $client->setFirstname($faker->firstName());
            $client->setLastname($faker->lastName());
            $client->setRoles([self::ROLES[2]]);
            $client->setTelephone($faker->mobileNumber());
            $client->setEmail('client' . $i . '@gmail.com');
            $client->setPassword($this->passwordEncoder->encodePassword(
                $client,
                'client'
            ));
            $manager->persist($client);
            $this->addReference('user_client_' . $i, $client);
        }

        //Client for Demo
        $client = new User();
        $client->setFirstname('Demo');
        $client->setLastname('Client');
        $client->setRoles([self::ROLES[2]]);
        $client->setTelephone('02030400506');
        $client->setEmail('demo.client@gmail.com');
        $client->setPassword($this->passwordEncoder->encodePassword(
            $client,
            'client'
        ));
        $manager->persist($client);
        $this->addReference('demo_client', $client);

        // Random coaches
        for ($i = 0; $i <= CoachFixtures::MAX_COACH; $i++) {
            $coach = new User();
            $coach->setFirstname($faker->firstName());
            $coach->setLastname($faker->lastName());
            $coach->setRoles([self::ROLES[1]]);
            $coach->setTelephone($faker->mobileNumber());
            $coach->setEmail('coach' . $i . '@gmail.com');
            $coach->setPassword($this->passwordEncoder->encodePassword(
                $coach,
                'coach'
            ));
            $manager->persist($coach);
            $this->addReference('usercoach_' . $i, $coach); // Trace back ref
        }

        //Coach for Demo
        $coach = new User();
        $coach->setFirstname($faker->firstName());
        $coach->setLastname($faker->lastName());
        $coach->setRoles([self::ROLES[1]]);
        $coach->setTelephone($faker->mobileNumber());
        $coach->setEmail('demo.coach@gmail.com');
        $coach->setPassword($this->passwordEncoder->encodePassword(
            $coach,
            'coach'
        ));
        $manager->persist($coach);
        $this->addReference('coach', $coach);

        //Superadmin
        $superAdmin = new User();
        $superAdmin->setFirstname('Franck');
        $superAdmin->setLastname('Amouroux');
        $superAdmin->setRoles([self::ROLES[0]]);
        $superAdmin->setTelephone($faker->mobileNumber());
        $superAdmin->setEmail('superadmin@coachmoi.fr');
        $superAdmin->setPassword($this->passwordEncoder->encodePassword(
            $superAdmin,
            'superadmin'
        ));
        $manager->persist($superAdmin);

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['client'];
    }
}
