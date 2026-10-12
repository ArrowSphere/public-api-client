<?php

namespace ArrowSphere\PublicApiClient\Quotes\Request\SubEntities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

class CustomerPrices extends AbstractEntity
{
    public const COLUMN_RATE = 'rate';
    public const COLUMN_FIXED_PRICE = 'fixedPrice';

    /**
     * @var Rate|null
     */
    #[Property(type: Rate::class)]
    protected ?Rate $rate = null;

    /**
     * @var float|null
     */
    #[Property(type: 'float')]
    protected ?float $fixedPrice = null;

    /**
     * @return Rate|null
     */
    public function getRate(): ?Rate
    {
        return $this->rate;
    }

    /**
     * @return float|null
     */
    public function getFixedPrice(): ?float
    {
        return $this->fixedPrice;
    }
}
