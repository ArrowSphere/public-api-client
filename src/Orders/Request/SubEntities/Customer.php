<?php

namespace ArrowSphere\PublicApiClient\Orders\Request\SubEntities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

class Customer extends AbstractEntity
{
    public const COLUMN_REFERENCE = 'reference';
    public const COLUMN_PO_NUMBER = 'ponumber';

    /**
     * @var string
     */
    #[Property(required: true)]
    protected string $reference;

    /**
     * @var string|null
     */
    #[Property(name: 'ponumber')]
    protected ?string $poNumber = null;

    /**
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * @return string|null
     */
    public function getPoNumber(): ?string
    {
        return $this->poNumber;
    }
}
