<?php

namespace App\DataFixtures;

use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use Faker;

class UsersFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $passwordEncoder,
        private SluggerInterface $slugger
    ){}

    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr-FR');
        $admin = new Users();
        $admin->setEmail('admin');
        $admin->setLastname('Administrator');
        $admin->setFirstname('TerminaDDOS');
        $admin->setPassword(
            $this->passwordEncoder->hashPassword($admin, 'admin')
        );
        $admin->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);

        for($i = 1; $i <= 5; $i++) { 

            $user = new Users();
            $user->setEmail($faker->email);
            $user->setLastname($faker->lastName);
            $user->setFirstname($faker->firstName);
            $user->setPassword(
            $this->passwordEncoder->hashPassword($user, 'azeaze')            
            );

            $manager->persist($user);

        }

        $manager->flush();
    }
}
