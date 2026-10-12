<?php

namespace ArrowSphere\PublicApiClient\Licenses\Entities\Offer\PriceBand;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

/**
 * Class Prices
 */
class Prices extends AbstractEntity
{
    public const COLUMN_BUY = 'buy';

    public const COLUMN_SELL = 'sell';

    public const COLUMN_PUBLIC = 'public';

    /**
     * @var float
     */
    #[Property(name: self::COLUMN_BUY, type: 'float', required: true)]
    protected float $buy;

    /**
     * @var float
     */
    #[Property(name: self::COLUMN_SELL, type: 'float', required: true)]
    protected float $sell;

    /**
     * @var float
     */
    #[Property(name: self::COLUMN_PUBLIC, type: 'float', required: true)]
    protected float $public;

    /**
     * @return float
     */
    public function getBuy(): float
    {
        return $this->buy;
    }

    /**
     * @return float
     */
    public function getSell(): float
    {
        return $this->sell;
    }

    /**
     * @return float
     */
    public function getPublic(): float
    {
        return $this->public;
    }
}
