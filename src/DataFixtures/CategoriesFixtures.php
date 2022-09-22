<?php

namespace App\DataFixtures;

use App\Entity\Categories;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

class CategoriesFixtures extends Fixture
{
    private $counter = 1 ;

    public function __construct(private SluggerInterface $slugger){}
    
    public function load(ObjectManager $manager): void
    {
        $this->createCategory('Biographies', $manager);
        $this->createCategory('Science Fiction', $manager);
        $this->createCategory('Pédagogie', $manager);
        $this->createCategory('Polars', $manager);

        $manager->flush();
    }

    public function createCategory(string $name, ObjectManager $manager)
    {
        $category = new Categories();
        $category->setName($name);
        $category->setSlug($this->slugger->slug($category->getName())->lower());
        $manager->persist($category);

        $this->addReference('cat-'.$this->counter, $category);
        $this->counter++;

        return $category;
    }
}
