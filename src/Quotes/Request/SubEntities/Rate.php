<?php

namespace ArrowSphere\PublicApiClient\Quotes\Request\SubEntities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

class Rate extends AbstractEntity
{
    public const COLUMN_RATE_TYPE = 'rateType';
    public const COLUMN_VALUE = 'value';

    #[Property(required: true)]
    protected string $rateType;

    #[Property(type: 'float', required: true)]
    protected float $value;
}
