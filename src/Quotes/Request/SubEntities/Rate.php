<?php

namespace ArrowSphere\PublicApiClient\Quotes\Request\SubEntities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

class Rate extends AbstractEntity
{
    public const COLUMN_RATE_TYPE = 'rateType';
    public const COLUMN_VALUE = 'value';

    /**
     * @var string
     */
    #[Property(required: true)]
    protected string $rateType;

    /**
     * @var float
     */
    #[Property(type: 'float', required: true)]
    protected float $value;

    /**
     * @return string
     */
    public function getRateType(): string
    {
        return $this->rateType;
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }
}
