<?php

namespace App\DataFixtures;

use App\Entity\Franchise;
use App\Entity\Module;
use App\Entity\Structure;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class FranchiseFixtures extends Fixture
{
  public function load(ObjectManager $manager): void
  {
    $faker = Factory::create('fr_FR');
    for ($i = 0; $i < 20; $i++) {
      $franchise = new Franchise();
      $franchise->setName($faker->city);
      $franchise->setIsActive(true);
      $manager->persist($franchise);
      for ($j = 0; $j < rand(2,5); $j++) {
        $structure = new Structure();
        $structure->setAddress($faker->streetAddress);
        $structure->setZipcode($faker->postcode);
        $structure->setCity($franchise->getName());
        $structure->setIsActive(true);
        $structure->setFranchise($franchise);
        $manager->persist($structure);
        for ($k = 0; $k < 1; $k++) {
          $module = new Module();
          $module->setPlanning((bool)random_int(0, 1));
          $module->setRegistration((bool)random_int(0, 1));
          $module->setNegotiation((bool)random_int(0, 1));
          $module->setSale((bool)random_int(0, 1));
          $module->setAdvertising((bool)random_int(0, 1));
          $module->setMailing((bool)random_int(0, 1));
          $module->setTraining((bool)random_int(0, 1));
          $module->setStructure($structure);
          $manager->persist($module);
          }
      }
    }
    $manager->flush();
  }
}