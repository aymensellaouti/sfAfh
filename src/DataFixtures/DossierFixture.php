<?php

namespace App\DataFixtures;

use App\Entity\City;
use App\Entity\Dossier;
use App\Entity\Gouvernorat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class DossierFixture extends Fixture implements DependentFixtureInterface

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
        $cities = $manager->getRepository(City::class)->findAll();
        for($i=0; $i<10; $i++){
            $dossier = new Dossier();
            $dossier->setRefrence($this->generateRef())
                ->setStatus($status[rand(0, count($status) - 1)])
                ->setCreationDate(new \DateTime());
            $affectedCity = $cities[rand(0, count($cities) - 1)];
            $affectedGouvernorat = $affectedCity->getGouvernorat();
            $dossier->setCity($affectedCity);
            $dossier->setGouvernorat($affectedGouvernorat);
            $manager->persist($dossier);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            PersonFixture::class,
            GouvernoratFixtures::class
        ];
        // TODO: Implement getDependencies() method.
    }
}
