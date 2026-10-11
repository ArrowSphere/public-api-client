<?php

namespace ArrowSphere\PublicApiClient\Orders\Entities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

class OrdersProduct extends AbstractEntity
{
    public const COLUMN_SKU = 'sku';

    public const COLUMN_NAME = 'name';

    public const COLUMN_CLASSIFICATION = 'classification';

    public const COLUMN_VENDOR_NAME = 'vendorName';

    public const COLUMN_PROGRAM_NAME = 'programName';

    public const COLUMN_PROGRAM = 'program';

    public const COLUMN_IDENTIFIERS = 'identifiers';

    public const COLUMN_QUANTITY = 'quantity';

    public const COLUMN_STATUS = 'status';

    public const COLUMN_DATE_STATUS = 'dateStatus';

    public const COLUMN_DETAILED_STATUS = 'detailedStatus';

    public const COLUMN_IS_ADDON = 'isAddon';

    public const COLUMN_IS_TRIAL = 'isTrial';

    public const COLUMN_ARROW_SUB_CATEGORIES = 'arrowSubCategories';

    public const COLUMN_PRICES = 'prices';

    public const COLUMN_SUBSCRIPTION = 'subscription';

    public const COLUMN_LICENSE = 'license';

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_SKU, required: true)]
    protected string $sku;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_NAME, required: true)]
    protected string $name;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_CLASSIFICATION, required: true)]
    protected string $classification;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_VENDOR_NAME, required: true)]
    protected string $vendorName;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_PROGRAM_NAME, required: true)]
    protected string $programName;

    /**
     * @var Program
     */
    #[Property(name: self::COLUMN_PROGRAM, type: Program::class, required: true)]
    protected Program $program;

    /**
     * @var Identifiers
     */
    #[Property(name: self::COLUMN_IDENTIFIERS, type: Identifiers::class, required: true)]
    protected Identifiers $identifiers;

    /**
     * @var int
     */
    #[Property(name: self::COLUMN_QUANTITY, type: 'int', required: true)]
    protected int $quantity;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_STATUS)]
    protected string $status = '';

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_DATE_STATUS)]
    protected string $dateStatus = '';

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_DETAILED_STATUS)]
    protected string $detailedStatus = '';

    /**
     * @var bool
     */
    #[Property(name: self::COLUMN_IS_ADDON, type: 'bool')]
    protected bool $isAddon = false;

    /**
     * @var bool
     */
    #[Property(name: self::COLUMN_IS_TRIAL, type: 'bool')]
    protected bool $isTrial = false;

    /**
     * @var string[]
     */
    #[Property(name: self::COLUMN_ARROW_SUB_CATEGORIES, isArray: true)]
    protected array $arrowSubCategories = [];

    /**
     * @var Prices
     */
    #[Property(name: self::COLUMN_PRICES, type: Prices::class, required: true)]
    protected Prices $prices;

    /**
     * @var Reference|null
     */
    #[Property(name: self::COLUMN_SUBSCRIPTION, type: Reference::class, serializeNull: true)]
    protected ?Reference $subscription = null;

    /**
     * @var Reference|null
     */
    #[Property(name: self::COLUMN_LICENSE, type: Reference::class, serializeNull: true)]
    protected ?Reference $license = null;

    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->sku;
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
    public function getClassification(): string
    {
        return $this->classification;
    }

    /**
     * @return string
     */
    public function getVendorName(): string
    {
        return $this->vendorName;
    }

    /**
     * @return string
     */
    public function getProgramName(): string
    {
        return $this->programName;
    }

    /**
     * @return Program
     */
    public function getProgram(): Program
    {
        return $this->program;
    }

    /**
     * @return Identifiers
     */
    public function getIdentifiers(): Identifiers
    {
        return $this->identifiers;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getDateStatus(): string
    {
        return $this->dateStatus;
    }

    /**
     * @return string
     */
    public function getDetailedStatus(): string
    {
        return $this->detailedStatus;
    }

    /**
     * @return bool
     */
    public function getIsAddon(): bool
    {
        return $this->isAddon;
    }

    /**
     * @return bool
     */
    public function getIsTrial(): bool
    {
        return $this->isTrial;
    }

    /**
     * @return string[]
     */
    public function getArrowSubCategories(): array
    {
        return $this->arrowSubCategories;
    }

    /**
     * @return Prices
     */
    public function getPrices(): Prices
    {
        return $this->prices;
    }

    /**
     * @return Reference|null
     */
    public function getSubscription(): ?Reference
    {
        return $this->subscription;
    }

    /**
     * @return Reference|null
     */
    public function getLicense(): ?Reference
    {
        return $this->license;
    }
}
