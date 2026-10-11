<?php

namespace ArrowSphere\PublicApiClient\Customers\Entities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

class ProvisionResponse extends AbstractEntity
{
    public const COLUMN_STATUS = 'status';

    public const COLUMN_MESSAGE = 'message';

    public const COLUMN_ATTRIBUTES = 'attributes';

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_STATUS, required: true)]
    protected string $status;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_MESSAGE, required: true)]
    protected string $message;

    /**
     * @var Attribute[]
     */
    #[Property(name: self::COLUMN_ATTRIBUTES, type: Attribute::class, isArray: true)]
    protected array $attributes = [];

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return Attribute[]
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }
}
