<?php

namespace ArrowSphere\PublicApiClient\Licenses\Entities\Offer\PriceBand;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;
use ArrowSphere\PublicApiClient\Licenses\Entities\Offer\PriceBand\Identifiers\Arrowsphere;
use ArrowSphere\PublicApiClient\Licenses\Entities\Offer\PriceBand\Identifiers\Erp;

/**
 * Class Identifiers
 */
class Identifiers extends AbstractEntity
{
    public const COLUMN_ARROWSPHERE = 'arrowsphere';

    public const COLUMN_ERP = 'erp';

    /**
     * @var Arrowsphere
     */
    #[Property(name: self::COLUMN_ARROWSPHERE, type: Arrowsphere::class, required: true)]
    protected Arrowsphere $arrowsphere;

    /**
     * @var Erp|null
     */
    #[Property(name: self::COLUMN_ERP, type: Erp::class)]
    protected ?Erp $erp = null;

    /**
     * @return Arrowsphere
     */
    public function getArrowsphere(): Arrowsphere
    {
        return $this->arrowsphere;
    }

    /**
     * @return Erp|null
     */
    public function getErp(): ?Erp
    {
        return $this->erp;
    }
}
