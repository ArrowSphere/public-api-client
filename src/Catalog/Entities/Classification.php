<?php

namespace ArrowSphere\PublicApiClient\Catalog\Entities;

use ArrowSphere\PublicApiClient\Entities\Exception\EntitiesException;
use JsonSerializable;

/**
 * Class Classification
 *
 * Its serialization is its name, a string, which the attribute-based entities cannot return.
 */
class Classification implements JsonSerializable
{
    public const COLUMN_NAME = 'name';

    /**
     * @var string
     */
    private string $name;

    /**
     * Classification constructor.
     *
     * @param array $data
     *
     * @throws EntitiesException
     */
    public function __construct(array $data)
    {
        if (! isset($data[self::COLUMN_NAME])) {
            throw new EntitiesException(static::class . ': Missing field: ' . self::COLUMN_NAME);
        }

        $this->name = (string) $data[self::COLUMN_NAME];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    public function jsonSerialize(): string
    {
        return $this->name;
    }
}
