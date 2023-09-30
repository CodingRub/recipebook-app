<?php

namespace App\Factory;

use App\Entity\Preparation;
use App\Repository\PreparationRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Preparation>
 *
 * @method        Preparation|Proxy create(array|callable $attributes = [])
 * @method static Preparation|Proxy createOne(array $attributes = [])
 * @method static Preparation|Proxy find(object|array|mixed $criteria)
 * @method static Preparation|Proxy findOrCreate(array $attributes)
 * @method static Preparation|Proxy first(string $sortedField = 'id')
 * @method static Preparation|Proxy last(string $sortedField = 'id')
 * @method static Preparation|Proxy random(array $attributes = [])
 * @method static Preparation|Proxy randomOrCreate(array $attributes = [])
 * @method static PreparationRepository|RepositoryProxy repository()
 * @method static Preparation[]|Proxy[] all()
 * @method static Preparation[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Preparation[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Preparation[]|Proxy[] findBy(array $attributes)
 * @method static Preparation[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Preparation[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class PreparationFactory extends ModelFactory
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
            'description' => self::faker()->text(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Preparation $preparation): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Preparation::class;
    }
}
