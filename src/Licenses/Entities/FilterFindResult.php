<?php

namespace ArrowSphere\PublicApiClient\Licenses\Entities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

/**
 * Class FilterFindResult
 */
class FilterFindResult extends AbstractEntity
{
    public const COLUMN_NAME = 'name';

    public const COLUMN_VALUES = 'values';

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_NAME, required: true)]
    protected string $name;

    /**
     * @var array
     */
    #[Property(name: self::COLUMN_VALUES, type: 'array')]
    protected array $values = [];

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getValues(): array
    {
        return $this->values;
    }
}
