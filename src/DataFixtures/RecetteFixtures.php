<?php

namespace App\DataFixtures;

use App\Entity\Aliment;
use App\Factory\IngredientFactory;
use App\Factory\NoteFactory;
use App\Factory\PreparationFactory;
use App\Factory\RecetteFactory;
use App\Factory\TypeRecetteFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class RecetteFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $file = file_get_contents(__DIR__ . '/data/recettes.json');
        $json_decoded = json_decode($file);
        foreach ($json_decoded as $line) {
            RecetteFactory::createOne([
                'name' => $line->nom,
                'preparation' => PreparationFactory::createMany(4),
                'notes' => NoteFactory::createMany(4)
            ]);
        }
    }

    public function getDependencies()
    {
        return [
            TypeRecetteFixtures::class,
            AlimentFixtures::class,
            IngredientFixtures::class,
            TagFixtures::class,
        ];
    }
}
