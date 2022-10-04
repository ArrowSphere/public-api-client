<?php

namespace ArrowSphere\PublicApiClient\Catalog\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

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

    protected const VALIDATION_RULES = [
        self::COLUMN_CLASSIFICATION => 'required',
        self::COLUMN_MARKETPLACE    => 'required',
        self::COLUMN_NAME           => 'required',
        self::COLUMN_REFERENCE      => 'required',
        self::COLUMN_VENDOR         => 'required',
        self::COLUMN_VENDOR_CODE    => 'required',
    ];

    /**
     * @var string
     */
    private $classification;

    /**
     * @var string
     */
    private $marketplace;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $reference;

    /**
     * @var string
     */
    private $vendor;

    /**
     * @var string
     */
    private $vendorCode;

    /**
     * Family constructor.
     *
     * @param array $data
     *
     * @throws EntityValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->classification = $data[self::COLUMN_CLASSIFICATION];
        $this->marketplace = $data[self::COLUMN_MARKETPLACE];
        $this->name = $data[self::COLUMN_NAME];
        $this->reference = $data[self::COLUMN_REFERENCE];
        $this->vendor = $data[self::COLUMN_VENDOR];
        $this->vendorCode = $data[self::COLUMN_VENDOR_CODE];
    }

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

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_CLASSIFICATION => $this->classification,
            self::COLUMN_MARKETPLACE    => $this->marketplace,
            self::COLUMN_NAME           => $this->name,
            self::COLUMN_REFERENCE      => $this->reference,
            self::COLUMN_VENDOR         => $this->vendor,
            self::COLUMN_VENDOR_CODE    => $this->vendorCode,
        ];
    }
}
