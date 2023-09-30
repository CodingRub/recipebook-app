<?php

namespace App\DataFixtures;

use App\Factory\TypeRecetteFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TypeRecetteFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $file = file_get_contents(__DIR__.'/data/typeRecette.json');
        $json_decoded = json_decode($file);
        foreach ($json_decoded as $line) {
            TypeRecetteFactory::createOne(['name' => $line->nom]);
        }
    }
}
