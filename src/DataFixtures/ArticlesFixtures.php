<?php

namespace App\DataFixtures;

use App\Entity\Articles;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;
use Faker;

use App\DataFixtures\CategoriesFixtures;
use App\DataFixtures\UsersFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class ArticlesFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(private SluggerInterface $slugger){}

    public function load(ObjectManager $manager): void
    {
        //Use the Factory to create the fixtures
        $faker = Faker\Factory::create('fr-FR');

        for($i = 1; $i <= 20; $i++) { 

            $article = new Articles();
            $article->setTitle($faker->sentence(1));
            $article->setContent($faker->text());
            $article->setSlug($this->slugger->slug($article->getTitle())->lower());

            $category = $this->getReference('cat-' . rand(1, 4));
            $article->setCategories($category);

            $this->setReference('art-'. $i, $article);

            $author = $this->getReference('author-' . rand(1, 4));
            $article->addAuthor($author);

            $manager->persist($article);

        }

        $manager->flush();

    }

    public function getDependencies()
    {
        return [
            CategoriesFixtures::class,
            UsersFixtures::class
        ];
    }
}
