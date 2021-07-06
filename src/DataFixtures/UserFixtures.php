<?php

namespace App\DataFixtures;

use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
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

        //Users
        for ($i = 0; $i <= self::MAX_USERS; $i++) {
            $client = new User();
            $client->setFirstname($faker->firstName());
            $client->setLastname($faker->lastName());
            $client->setRoles([self::ROLES[2]]);
            $client->setTelephone($faker->mobileNumber());
            $client->setEmail('client' . $i . '@gmail.com');
            $client->setPassword($this->passwordEncoder->encodePassword(
                $client,
                'usercoachmoi'
            ));
            $manager->persist($client);
            $this->addReference('user_' . $i, $client);
        }

        //Client
        $client = new User();
        $client->setFirstname('client');
        $client->setLastname('CLIENT');
        $client->setRoles([self::ROLES[2]]);
        $client->setTelephone('020304099');
        $client->setEmail('client@gmail.com');
        $client->setPassword($this->passwordEncoder->encodePassword(
            $client,
            'client'
        ));
        $manager->persist($client);
        $this->addReference('client', $client);

        //New client
        $newClient = new User();
        $newClient->setFirstname('New');
        $newClient->setLastname('Client');
        $newClient->setRoles(['ROLE_ADMIN']);
        $newClient->setTelephone('020304099');
        $newClient->setEmail('client.new@gmail.com');
        $newClient->setPassword($this->passwordEncoder->encodePassword(
            $newClient,
            'new'
        ));
        $manager->persist($newClient);
        $this->addReference('client_new', $newClient);

        // Fixture for coach's demo account
        for ($i = 0; $i <= CoachFixtures::MAX_COACH; $i++) {
            $coach = new User();
            $coach->setFirstname($faker->firstName());
            $coach->setLastname($faker->lastName());
            $coach->setRoles([self::ROLES[1]]);
            $coach->setTelephone($faker->mobileNumber());
            $coach->setEmail('coach' . $i . '@gmail.com');
            $coach->setPassword($this->passwordEncoder->encodePassword(
                $coach,
                'admincoachmoi'
            ));
            $manager->persist($coach);
            $this->addReference('usercoach_' . $i, $coach);
        }

        //Superadmin
        $superAdmin = new User();
        $superAdmin->setFirstname('Franck');
        $superAdmin->setLastname('Sangoku');
        $superAdmin->setRoles([self::ROLES[0]]);
        $superAdmin->setTelephone($faker->mobileNumber());
        $superAdmin->setEmail('franck@gmail.com');
        $superAdmin->setPassword($this->passwordEncoder->encodePassword(
            $superAdmin,
            'coachmoi'
        ));
        $manager->persist($superAdmin);

        $manager->flush();
    }
}
