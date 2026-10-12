<?php

namespace ArrowSphere\PublicApiClient\Licenses\Entities\Offer\PriceBand\Identifiers;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

/**
 * Class SaleConstraints
 */
class Arrowsphere extends AbstractEntity
{
    public const COLUMN_SKU = 'sku';

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_SKU, required: true)]
    protected string $sku;

    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->sku;
    }
}
