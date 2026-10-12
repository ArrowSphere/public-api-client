<?php

namespace ArrowSphere\PublicApiClient\Quotes\Request\SubEntities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

class Customer extends AbstractEntity
{
    public const COLUMN_REFERENCE = 'reference';

    /**
     * @var string
     */
    #[Property(required: true)]
    protected string $reference;

    /**
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }
}
