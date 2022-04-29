<?php

namespace App\DataFixtures;

use App\Entity\Options;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $names = ["None", "Balcony", "Terrace", "Pool"];
        
        for ($i = 0; $i < count($names); ++$i) {
        $option = new Options();

        $name = $names[$i];

        $option->setName($name);

        $manager->persist($option);
        $manager->flush();
    }
}
}