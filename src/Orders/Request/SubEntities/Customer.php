<?php

namespace ArrowSphere\PublicApiClient\Orders\Request\SubEntities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

class Customer extends AbstractEntity
{
    public const COLUMN_REFERENCE = 'reference';
    public const COLUMN_PO_NUMBER = 'poNumber';

    #[Property(required: true)]
    protected string $reference;

    #[Property(name: 'ponumber')]
    protected ?string $poNumber = null;
}
