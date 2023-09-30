<?php

namespace App\Factory;

use App\Entity\TypeAliment;
use App\Repository\TypeAlimentRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<TypeAliment>
 *
 * @method        TypeAliment|Proxy create(array|callable $attributes = [])
 * @method static TypeAliment|Proxy createOne(array $attributes = [])
 * @method static TypeAliment|Proxy find(object|array|mixed $criteria)
 * @method static TypeAliment|Proxy findOrCreate(array $attributes)
 * @method static TypeAliment|Proxy first(string $sortedField = 'id')
 * @method static TypeAliment|Proxy last(string $sortedField = 'id')
 * @method static TypeAliment|Proxy random(array $attributes = [])
 * @method static TypeAliment|Proxy randomOrCreate(array $attributes = [])
 * @method static TypeAlimentRepository|RepositoryProxy repository()
 * @method static TypeAliment[]|Proxy[] all()
 * @method static TypeAliment[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static TypeAliment[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static TypeAliment[]|Proxy[] findBy(array $attributes)
 * @method static TypeAliment[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static TypeAliment[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class TypeAlimentFactory extends ModelFactory
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
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(TypeAliment $typeAliment): void {})
        ;
    }

    protected static function getClass(): string
    {
        return TypeAliment::class;
    }
}
