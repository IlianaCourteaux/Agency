<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Properties;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class PropertiesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 30; $i++){

            $property = new Properties;
            $property  
                ->setTitle($faker->words(4, true))
                ->setPhoto($faker->imageUrl(null, 300, 300, 'house', true))
                ->setSurface($faker->numberBetween(20, 500))
                ->setPrice($faker->numberBetween(600, 1000000))
                ->setFloors($faker->numberBetween(1, 10))
                ->setRooms($faker->numberBetween(2, 20))
                ->setCity($faker->city())
                ->setType($faker->randomElement($array = array ('House','Appartment')))
                ->setTransactionType($faker->randomElement($array = array ('Sale','Rental')))
                ->setSlug($faker->word())
                ->setStatus($faker->boolean());

            $manager->persist($property);
        }
        $manager->flush();
    }
}