<?php

namespace App\DataFixtures;

use App\Factory\AlimentFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AlimentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $file = __DIR__.'/data/aliments.json';
        if (file_exists($file)) {
            $json = file_get_contents($file);
            $json_decoded = json_decode($json);
            if ($json_decoded !== null || json_last_error() === JSON_ERROR_NONE) {
                foreach ($json_decoded as $line) {
                    AlimentFactory::createOne(['name' => $line->nom, 'unite' => $line->unite]);
                }
            }
        }
    }


    public function getDependencies()
    {
        return [
            TypeAlimentFixtures::class
        ];
    }

}
