<?php

namespace App\DataFixtures;

use App\Entity\Articles;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;
use Faker;


class ArticlesFixtures extends Fixture
{
    public function __construct(private SluggerInterface $slugger){}

    public function load(ObjectManager $manager): void
    {
        //Use the Factory to create the fixtures
        $faker = Faker\Factory::create('fr-FR');

        for($i = 1; $i <= 20; $i++) { 

            $article = new Articles();
            $article->setTitle($faker->text(5));
            $article->setContent($faker->text());
            $article->setSlug($this->slugger->slug($article->getTitle()));

            $manager->persist($article);

        }

        $manager->flush();
    }
}
