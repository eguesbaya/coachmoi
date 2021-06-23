<?php

namespace App\DataFixtures;

use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

class UserFixtures extends Fixture implements FixtureGroupInterface
{
    public const MAX_USERS = 12;
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 0; $i <= self::MAX_USERS; $i++) {
            $user = new User();
            $user->setFirstname($faker->firstName());
            $user->setLastname($faker->lastName());
            $user->setTelephone($faker->phoneNumber());
            $user->setEmail($faker->email());
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'usercoachmoi'
            ));
            $manager->persist($user);
            $this->addReference('user_' . $i, $user);
        }

        $admin = new User();
        $admin->setFirstname('PrénomAdmin');
        $admin->setLastname('NomAdmin');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setTelephone('020304099');
        $admin->setEmail('emailadmin@gmail.com');
        $admin->setPassword($this->passwordEncoder->encodePassword(
            $admin,
            'admincoachmoi'
        ));
        $manager->persist($admin);


        $superAdmin = new User();
        $superAdmin->setFirstname('PrénomSuperAdmin');
        $superAdmin->setLastname('NomSuperAdmin');
        $superAdmin->setRoles(['ROLE_SUPER_ADMIN']);
        $superAdmin->setTelephone('02074099');
        $superAdmin->setEmail('emailsuperadmin@gmail.com');
        $superAdmin->setPassword($this->passwordEncoder->encodePassword(
            $superAdmin,
            'superadmincoachmoi'
        ));
        $manager->persist($superAdmin);

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['group1'];
    }
}
