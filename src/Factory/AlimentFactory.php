<?php

namespace App\Factory;

use App\Entity\Aliment;
use App\Repository\AlimentRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Aliment>
 *
 * @method        Aliment|Proxy create(array|callable $attributes = [])
 * @method static Aliment|Proxy createOne(array $attributes = [])
 * @method static Aliment|Proxy find(object|array|mixed $criteria)
 * @method static Aliment|Proxy findOrCreate(array $attributes)
 * @method static Aliment|Proxy first(string $sortedField = 'id')
 * @method static Aliment|Proxy last(string $sortedField = 'id')
 * @method static Aliment|Proxy random(array $attributes = [])
 * @method static Aliment|Proxy randomOrCreate(array $attributes = [])
 * @method static AlimentRepository|RepositoryProxy repository()
 * @method static Aliment[]|Proxy[] all()
 * @method static Aliment[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Aliment[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Aliment[]|Proxy[] findBy(array $attributes)
 * @method static Aliment[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Aliment[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class AlimentFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'name' => self::faker()->text(255),
            'type' => TypeAlimentFactory::new(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Aliment $aliment): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Aliment::class;
    }
}
