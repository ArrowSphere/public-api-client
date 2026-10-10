<?php

namespace ArrowSphere\PublicApiClient\Catalog\Entities;

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
     * @var string|null
     */
    #[Property(name: self::COLUMN_NAME, serializeNull: true)]
    protected ?string $name = null;

    /**
     * @var array
     */
    #[Property(name: self::COLUMN_VALUES, type: 'array')]
    protected array $values = [];

    /**
     * @return string|null
     */
    public function getName(): ?string
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
