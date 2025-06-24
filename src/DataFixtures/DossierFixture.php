<?php

namespace App\DataFixtures;

use App\Entity\Dossier;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class DossierFixture extends Fixture
{
    private function generateRef(): string {
        $chaines = "abcdefghijklmnopqrstuvwxyz ";
        $refCar = substr(str_shuffle($chaines),-2);
        $annees = [2025, 2022, 2020, 2023, 2024];
        return $annees[rand(0, count($annees) - 1)].$refCar.$annees[rand(0, count($annees) - 1)].'SI';
    }
    public function load(ObjectManager $manager): void
    {
        $status = ['C', 'A', 'N', 'D', 'S'];
        $faker = Factory::create('ar_AR');
        for($i=0; $i<10; $i++){
            $dossier = new Dossier();
            $dossier->setRefrence($this->generateRef())
                ->setStatus($status[rand(0, count($status) - 1)])
                ->setCreationDate(new \DateTime());
            $manager->persist($dossier);
        }
        $manager->flush();
    }
}
