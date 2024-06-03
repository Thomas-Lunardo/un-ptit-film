<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public const PROGRAMS = [
        [
            'title' => 'Iron Man',
            'synopsis' => 'Tony Stark devient Iron Man.',
            'poster' => 'https://fr.web.img3.acsta.net/medias/nmedia/18/62/89/45/18876909.jpg',
            'category' => 'category_Marvel',
        ],
        [
            'title' => 'The Incredible Hulk',
            'synopsis' => 'Les aventure des Bruce Banner joue par Edourd Norton.',
            'poster' => 'https://m.media-amazon.com/images/M/MV5BMTUyNzk3MjA1OF5BMl5BanBnXkFtZTcwMTE1Njg2MQ@@._V1_.jpg',
            'category' => 'category_Marvel',
        ],
        [
            'title' => 'Iron Man 2',
            'synopsis' => 'Tony Stark galère avec son générateur.',
            'poster' => 'https://m.media-amazon.com/images/M/MV5BMTUyNzk3MjA1OF5BMl5BanBnXkFtZTcwMTE1Njg2MQ@@._V1_.jpg',
            'category' => 'category_Marvel',
        ],
        [
            'title' => 'Thor',
            'synopsis' => 'Thor sur Terre sans pouvoir.',
            'poster' => 'https://fr.web.img3.acsta.net/medias/nmedia/18/77/96/35/19701393.jpg',
            'category' => 'category_Marvel',
        ],
        [
            'title' => 'Capitain America',
            'synopsis' => 'Les aventures de Steve Rogers.',
            'poster' => 'https://fr.web.img4.acsta.net/medias/nmedia/18/84/69/36/19774937.jpg',
            'category' => 'category_Marvel',
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
            $manager->persist($program);
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
