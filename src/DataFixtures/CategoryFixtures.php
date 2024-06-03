<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    const CATEGORIES = [
        'Action américaine',
        'Action française',
        'Biopic',
        'Catastrophe',
        'Comédie américaine',
        'Comédie française',
        'DC comics',
        'Dessin animé',
        'Documentaire',
        'Drame',
        'Espionnage',
        'Fantastique',
        'Guerre',
        'Horreur',
        'Marvel',
        'Samourai',
        'Sicence fiction',
        'Western',
        'X-men',
    ];
    public function load(ObjectManager $manager)
    {
        foreach (self::CATEGORIES as $key => $categoryName) {
            $category = new Category();
            $category->setName($categoryName);
            $manager->persist($category);
            $this->addReference('category_' . $categoryName, $category);
        }
        
        $manager->flush();
    }
}