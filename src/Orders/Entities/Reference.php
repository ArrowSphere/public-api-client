<?php

namespace ArrowSphere\PublicApiClient\Orders\Entities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

class Reference extends AbstractEntity
{
    public const COLUMN_REFERENCE = 'reference';

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_REFERENCE, required: true)]
    protected string $reference;

    /**
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }
}
