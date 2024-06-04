<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $season = new Episode();
        $season->setTitle('The One Where Monica Gets a Roommate');
        $season->setSynopsis('Monica and the gang introduce Rachel to the "real world" after she leaves her fiancé at the altar.');
        $season->setNumber('1');
        $season->setSeason($this->getReference('season1_Friends'));
        $manager->persist($season);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
          SeasonFixtures::class,
        ];
    }
}
