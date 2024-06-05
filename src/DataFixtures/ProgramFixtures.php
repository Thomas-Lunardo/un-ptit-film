<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public const PROGRAMS = [
        [
            'title' => 'Friends',
            'synopsis' => 'La série entre toutes les séries',
            'poster' => 'https://fr.web.img2.acsta.net/pictures/18/11/13/14/05/2764761.jpg',
            'category' => 'category_Comédie américaine',
        ],
        [
            'title' => 'NCIS',
            'synopsis' => 'Gibbs et les méchants',
            'poster' => 'https://fr.web.img3.acsta.net/pictures/19/06/18/12/13/0214170.jpg',
            'category' => 'category_Action américaine',
        ],
        [
            'title' => 'Shogun',
            'synopsis' => 'L\'histoire d\'AnjinSama au Japon',
            'poster' => 'https://fr.web.img6.acsta.net/pictures/23/11/29/16/34/1794966.jpg',
            'category' => 'category_Samourai',
        ],
     ];
    
    public function load(ObjectManager $manager): void
    {
        foreach (self::PROGRAMS as $key => $programName) {
            $program = new Program();
            $program->setTitle($programName['title']);
            $program->setSynopsis($programName['synopsis']);
            $program->setPoster($programName['poster']);
            $program->setCategory($this->getReference($programName['category']));
            $this->addReference('program_' . $programName['title'], $program);
            $manager->persist($program);
        }

        $faker = Factory::create('fr_FR');

        for ($i=1; $i <=10 ; $i++) { 
            $program = new Program();
            $program->setTitle($faker->name);
            $program->setSynopsis($faker->paragraphs(2, true));
            $program->setPoster($faker->imageUrl(640, 480, 'animals', true));
            $program->setCategory($this->getReference('category_' . $faker->numberBetween(1, 5)));

            $manager->persist($program);
            $this->addReference('program_' . $i, $program);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
          CategoryFixtures::class,
        ];
    }
}
