<?php

namespace App\DataFixtures;

use App\Entity\Dossier;
use App\Entity\Hobby;
use App\Entity\Job;
use App\Entity\Person;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PersonFixture extends Fixture implements DependentFixtureInterface

{
    public function load(ObjectManager $manager): void
    {
        $chaines = "abcdefghijklmnopqrstuvwxyz ";
        $fakerAr = Factory::create('ar_SA');
        $faker = Factory::create('fr_FR');
        $jobs = $manager->getRepository(Job::class)->findAll();
        $hobbies = $manager->getRepository(Hobby::class)->findAll();
        for($i=0; $i<100; $i++){
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
            $person->setJob($jobs[rand(0, count($jobs)-1)]);
            shuffle($hobbies);
            for ($j=0; $j < 3; $j++) {
                $person->addHobby($hobbies[$j]);
            }
            $manager->persist($person);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        // TODO: Implement getDependencies() method.
        return [
            JobFixture::class,
            HobbyFixture::class,
        ];
    }
}
