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

        //Coach?
        $admin = new User();
        $admin->setFirstname('PrénomAdmin');
        $admin->setLastname('NomAdmin');
        $admin->setRoles([self::ROLES[1]]);
        $admin->setTelephone('020304099');
        $admin->setEmail('emailadmin@gmail.com');
        $admin->setPassword($this->passwordEncoder->encodePassword(
            $admin,
            'admincoachmoi'
        ));
        $manager->persist($admin);
        $this->addReference('admin', $admin);

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
