<?php

namespace Tests\Support;

use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Support\Arr;

abstract class BaseApiFactory
{
    public function __construct(protected ?Generator $faker)
    {
    }

    abstract public function definition(): array;
    abstract public function make(array $extra = []): mixed;

    public static function new(): static
    {
        return new static(self::withFaker());
    }

    protected function makeArray(array $extra = []): array
    {
        return array_merge(
            $this->definition(),
            Arr::only($extra, array_keys($this->definition()))
        );
    }

    private static function withFaker(): ?Generator
    {
        if (!class_exists(Generator::class)) {
            return null;
        }

        return Container::getInstance()->make(Generator::class);
    }
}
