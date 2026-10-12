<?php

namespace ArrowSphere\PublicApiClient\Licenses\Entities\Offer\PriceBand;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;
use ArrowSphere\PublicApiClient\Licenses\Entities\Offer\PriceBand\Identifiers\Arrowsphere;

/**
 * Class SaleConstraints
 */
class Identifiers extends AbstractEntity
{
    public const COLUMN_ARROWSPHERE = 'arrowsphere';

    /**
     * @var Arrowsphere
     */
    #[Property(name: self::COLUMN_ARROWSPHERE, type: Arrowsphere::class, required: true)]
    protected Arrowsphere $arrowsphere;

    /**
     * @return Arrowsphere
     */
    public function getArrowsphere(): Arrowsphere
    {
        return $this->arrowsphere;
    }
}
