<?php

namespace ArrowSphere\PublicApiClient\Licenses\Entities\Offer\PriceBand;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

/**
 * Class SaleConstraints
 */
class SaleConstraints extends AbstractEntity
{
    public const COLUMN_MIN_QUANTITY = 'minQuantity';

    public const COLUMN_MAX_QUANTITY = 'maxQuantity';

    /**
     * @var float|null
     */
    #[Property(name: self::COLUMN_MIN_QUANTITY, type: 'float', serializeNull: true)]
    protected ?float $minQuantity = null;

    /**
     * @var float|null
     */
    #[Property(name: self::COLUMN_MAX_QUANTITY, type: 'float', serializeNull: true)]
    protected ?float $maxQuantity = null;

    /**
     * @return float|null
     */
    public function getMinQuantity(): ?float
    {
        return $this->minQuantity;
    }

    /**
     * @return float|null
     */
    public function getMaxQuantity(): ?float
    {
        return $this->maxQuantity;
    }
}
