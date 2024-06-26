<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

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

        $faker = Factory::create('fr_FR');

        for ($i=1; $i <= 5 ; $i++) { 
            $category = new Category();

            $category->setName($faker->word());

            $manager->persist($category);

            $this->addReference('category_' . $i, $category);
        }

        $manager->flush();
    }
}