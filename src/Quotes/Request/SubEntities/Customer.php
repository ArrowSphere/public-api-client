<?php

namespace ArrowSphere\PublicApiClient\Quotes\Request\SubEntities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

class Customer extends AbstractEntity
{
    public const COLUMN_REFERENCE = 'reference';

    #[Property(required: true)]
    protected string $reference;
}
