<?php

namespace App\DataFixtures;

use App\Entity\Images;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\DataFixtures\ArticlesFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;


class ImagesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
            $faker = Faker\Factory::create('fr-FR');

            for($i = 1; $i <= 50; $i++) { 

                $image = new Images();
                $image->setName($faker->imageUrl(640, 480, 'animals', true));

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
