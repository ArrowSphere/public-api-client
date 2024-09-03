<?php

namespace ArrowSphere\PublicApiClient\Quotes\Request\SubEntities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

class CustomerPrices extends AbstractEntity
{
    public const COLUMN_RATE = 'rate';
    public const COLUMN_VALUE = 'value';

    #[Property(type: Rate::class, required: true)]
    protected Rate $rate;

    #[Property(type: 'float', required: true)]
    protected float $value;
}
