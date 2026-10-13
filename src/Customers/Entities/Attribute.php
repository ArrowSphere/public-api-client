<?php

namespace ArrowSphere\PublicApiClient\Customers\Entities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

class Attribute extends AbstractEntity
{
    public const COLUMN_SCHEDULED_NAME = 'name';

    public const COLUMN_VALUE = 'value';

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_SCHEDULED_NAME, required: true)]
    protected string $name;

    /**
     * @var string|null Null when the value of the attribute is not filled for the customer
     */
    #[Property(name: self::COLUMN_VALUE, serializeNull: true)]
    protected ?string $value = null;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getValue(): ?string
    {
        return $this->value;
    }
}
