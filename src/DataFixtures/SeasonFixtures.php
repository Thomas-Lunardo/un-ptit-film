<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
  public function load(ObjectManager $manager): void
  {
    $season = new Season();
    $season->setNumber(1);
    $season->setYear(1994);
    $season->setDescription('La team meet Rachel');
    $season->setProgram($this->getReference('program_Friends'));
    $this->addReference('season1_Friends', $season);
    $manager->persist($season);

    $season = new Season();
    $season->setNumber(2);
    $season->setYear(1995);
    $season->setDescription('Friends le retour');
    $season->setProgram($this->getReference('program_Friends'));
    $this->addReference('season2_Friends', $season);
    $manager->persist($season);

    $faker = Factory::create('en_US');

    foreach (ProgramFixtures::PROGRAMS as $programList) {
      for ($i = 1; $i <= 5; $i++) {
        $season = new Season();
        $season->setNumber($i);
        $season->setYear($faker->year());
        $season->setDescription($faker->paragraph(3, true));
        $season->setProgram($this->getReference('program_' . $programList['title']));
        $this->addReference('program_' . $programList['title'] . 'season_' . $i, $season);
        $manager->persist($season);
      }
    }

    $manager->flush();
  }

  public function getDependencies()
  {
    return [
      ProgramFixtures::class,
    ];
  }
}
