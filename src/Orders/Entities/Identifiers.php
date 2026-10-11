<?php

namespace ArrowSphere\PublicApiClient\Orders\Entities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

class Identifiers extends AbstractEntity
{
    public const COLUMN_VENDOR = 'vendor';

    /**
     * @var Vendor
     */
    #[Property(name: self::COLUMN_VENDOR, type: Vendor::class, required: true)]
    protected Vendor $vendor;

    /**
     * @return Vendor
     */
    public function getVendor(): Vendor
    {
        return $this->vendor;
    }
}
