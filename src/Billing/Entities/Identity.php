<?php

namespace ArrowSphere\PublicApiClient\Billing\Entities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

class Identity extends AbstractEntity
{
    public const COLUMN_REFERENCE = 'reference';
    public const COLUMN_NAME = 'name';

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_REFERENCE, required: true)]
    protected string $reference;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_NAME, required: true)]
    protected string $name;

    /**
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
