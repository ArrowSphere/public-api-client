<?php

namespace ArrowSphere\PublicApiClient\Quotes\Request\SubEntities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

class CustomerPrices extends AbstractEntity
{
    public const COLUMN_RATE = 'rate';
    public const COLUMN_FIXED_PRICE = 'fixedPrice';

    #[Property(type: Rate::class)]
    protected ?Rate $rate = null;

    #[Property(type: 'float')]
    protected ?float $fixedPrice = null;
}
