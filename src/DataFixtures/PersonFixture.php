<?php

namespace App\DataFixtures;

use App\Entity\Dossier;
use App\Entity\Person;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PersonFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $chaines = "abcdefghijklmnopqrstuvwxyz ";
        $fakerAr = Factory::create('ar_AR');
        $faker = Factory::create('fr_FR');
        for($i=0; $i<10; $i++){
            $person = new Person();
            $person
                ->setAge($faker->numberBetween(18, 60));
                if ($i % 2 == 0) {
                    $person->setName($faker->name())
                           ->setFirstname($faker->firstName()) ;
                } else {
                    $person
                    ->setName($fakerAr->name())
                        ->setFirstname($fakerAr->firstName());

                }
                $person
                ->setCin(substr(str_shuffle($chaines), -8))
                ->setPath('')
            ;
            $manager->persist($person);
        }
        $manager->flush();
    }
}
