<?php

namespace App\DataFixtures;

use App\Entity\Images;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

use App\DataFixtures\ArticlesFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class ImagesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
            $faker = Faker\Factory::create('fr-FR');

            for($i = 1; $i <= 50; $i++) { 

                $image = new Images();
                $image->setName($faker->image(null, 640, 480));

                $article = $this->getReference('art-' . rand(1, 20));
                $image->addArticle($article);
    
                $manager->persist($image);
    
            }

            $manager->flush();

    }

    public function getDependencies()
    {
        return [
            ArticlesFixtures::class
        ];
    }
}
