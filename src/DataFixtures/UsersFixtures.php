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

        for ($i = 1; $i <= 4; $i++) {

        $admin = new Users();
        $admin->setEmail($faker->email);
        $admin->setLastname($faker->lastName);
        $admin->setFirstname($faker->firstName);
        $admin->setPassword(
            $this->passwordEncoder->hashPassword($admin, 'admin')
        );
        $admin->setRoles(['ROLE_ADMIN']);
        $this->setReference('author-'. $i, $admin);


        $manager->persist($admin);
        }

        for($j = 1; $j <= 5; $j++) { 

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
