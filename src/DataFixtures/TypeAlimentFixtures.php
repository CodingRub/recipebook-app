<?php

namespace App\DataFixtures;

use App\Entity\TypeAliment;
use App\Factory\TypeAlimentFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TypeAlimentFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $file = file_get_contents(__DIR__.'/data/typeAliments.json');
        $json_decoded = json_decode($file);
        foreach ($json_decoded as $line) {
            TypeAlimentFactory::createOne(['name' => $line->nom]);
        }
    }
}
