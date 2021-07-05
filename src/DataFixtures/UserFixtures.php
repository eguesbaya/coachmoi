<?php

namespace App\DataFixtures;

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
        //Users
        for ($i = 0; $i <= self::MAX_USERS; $i++) {
            $user = new User();
            $user->setFirstname('Prénom ' . $i);
            $user->setLastname('Nom ' . $i);
            $user->setTelephone('020304050' . $i);
            $user->setEmail('email' . $i . '@gmail.com');
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'usercoachmoi'
            ));
            $manager->persist($user);
            $this->addReference('user_' . $i, $user);
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
        $coach = new User();
        $coach->setFirstname('COACH');
        $coach->setLastname('MOI');
        $coach->setRoles(['ROLE_ADMIN']);
        $coach->setTelephone('020304099');
        $coach->setEmail('coach@gmail.com');
        $coach->setPassword($this->passwordEncoder->encodePassword(
            $coach,
            'admincoachmoi'
        ));
        $manager->persist($coach);
        $this->addReference('coach', $coach);

        //Superadmin
        $superAdmin = new User();
        $superAdmin->setFirstname('PrénomSuperAdmin');
        $superAdmin->setLastname('NomSuperAdmin');
        $superAdmin->setRoles([self::ROLES[0]]);
        $superAdmin->setTelephone('02074099');
        $superAdmin->setEmail('emailsuperadmin@gmail.com');
        $superAdmin->setPassword($this->passwordEncoder->encodePassword(
            $superAdmin,
            'superadmincoachmoi'
        ));
        $manager->persist($superAdmin);

        $manager->flush();
    }
}
