<?php

namespace ArrowSphere\PublicApiClient\Catalog\Entities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

/**
 * Class Family
 */
class Family extends AbstractEntity
{
    public const COLUMN_CLASSIFICATION = 'classification';

    public const COLUMN_MARKETPLACE = 'marketplace';

    public const COLUMN_NAME = 'name';

    public const COLUMN_REFERENCE = 'reference';

    public const COLUMN_VENDOR = 'vendor';

    public const COLUMN_VENDOR_CODE = 'vendorCode';

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_CLASSIFICATION, required: true)]
    protected string $classification;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_MARKETPLACE, required: true)]
    protected string $marketplace;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_NAME, required: true)]
    protected string $name;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_REFERENCE, required: true)]
    protected string $reference;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_VENDOR, required: true)]
    protected string $vendor;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_VENDOR_CODE, required: true)]
    protected string $vendorCode;

    /**
     * @return string
     */
    public function getClassification(): string
    {
        return $this->classification;
    }

    /**
     * @return string
     */
    public function getMarketplace(): string
    {
        return $this->marketplace;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * @return string
     */
    public function getVendor(): string
    {
        return $this->vendor;
    }

    /**
     * @return string
     */
    public function getVendorCode(): string
    {
        return $this->vendorCode;
    }
}
