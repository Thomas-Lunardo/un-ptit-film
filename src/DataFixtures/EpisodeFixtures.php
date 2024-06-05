<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $episode = new Episode();
        $episode->setTitle('The One Where Monica Gets a Roommate');
        $episode->setSynopsis('Monica and the gang introduce Rachel to the "real world" after she leaves her fiancé at the altar.');
        $episode->setNumber('1');
        $episode->setSeason($this->getReference('season1_Friends'));
        $manager->persist($episode);

        $faker = Factory::create('en_US');

        foreach (ProgramFixtures::PROGRAMS as $programList) {
            for($seasonNumber = 1; $seasonNumber <= 5; $seasonNumber++) {
                for ($i=0; $i <= 10 ; $i++) { 
                    $episode = new Episode();
                    $episode->setTitle($faker->name);
                    $episode->setSynopsis($faker->text(255));
                    $episode->setNumber($i);
                    $episode->setSeason($this->getReference('program_' . $programList['title'] . 'season_' . $seasonNumber));
                    $manager->persist($episode);
                }
            }
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            SeasonFixtures::class,
        ];
    }
}
