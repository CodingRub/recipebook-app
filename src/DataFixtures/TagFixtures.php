<?php

namespace App\DataFixtures;

use App\Entity\Aliment;
use App\Factory\IngredientFactory;
use App\Factory\RecetteFactory;
use App\Factory\TagFactory;
use App\Factory\TypeRecetteFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class TagFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $file = file_get_contents(__DIR__.'/data/tags.json');
        $json_decoded = json_decode($file);
        foreach ($json_decoded as $line) {
            TagFactory::createOne(['name' => $line->nom]);
        }
    }

    public function getDependencies()
    {
        return [
            TypeRecetteFixtures::class,
            AlimentFixtures::class,
            IngredientFixtures::class,
        ];
    }
}
