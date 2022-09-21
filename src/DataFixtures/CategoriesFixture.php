<?php

namespace App\DataFixtures;

use App\Entity\Categories;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

class CategoriesFixture extends Fixture
{
    public function __construct(private SluggerInterface $slugger){}
    
    public function load(ObjectManager $manager): void
    {
        $category = new Categories();
        $category->setName('Informatique');
        $category->setSlug($this->slugger->slug($category->getName())->lower());
        $manager->persist($category);

        $manager->flush();
    }
}
