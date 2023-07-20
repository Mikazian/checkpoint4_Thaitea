<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public const MEMBERS_COUNT = 5;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $admin = new User();
        $admin->setUsername('Mikazian');
        $admin->setEmail('admin@thaitea.fr');
        $admin->setRoles(['ROLE_ADMIN']);
        $hashedPassword = $this->passwordHasher->hashPassword(
            $admin,
            'adminpassword'
        );
        $admin->setPassword($hashedPassword);

        $this->addReference('admin', $admin);

        $manager->persist($admin);
        $manager->flush();

        for ($i = 0; $i <= self::MEMBERS_COUNT; $i++) {
            $member = new User();
            $member->setUsername('Utilisateur' . $i);
            $member->setEmail('member' . $i . '@thaitea.fr');
            $member->setRoles(['ROLE_USER']);
            $hashedPassword = $this->passwordHasher->hashPassword(
                $member,
                'memberpassword'
            );
            $member->setPassword($hashedPassword);

            $manager->persist($member);

            $manager->flush();
        }
    }
}
