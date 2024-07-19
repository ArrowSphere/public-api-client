<?php

namespace ArrowSphere\PublicApiClient\Orders\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;

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
     * @var string product SKU
     */
    private string $sku;

    /**
     * @var string Product name
     */
    private string $name;

    /**
     * @var string Product classification (IaaS, SaaS, PSW...)
     */
    private string $classification;

    /**
     * @var string Product vendor name
     */
    private string $vendorName;

    /**
     * @var string Product Program name
     */
    private string $programName;

    /**
     * @var Program
     */
    private Program $program;

    /**
     * @var Identifiers
     */
    private Identifiers $identifiers;

    /**
     * @var int Number of products bought
     */
    private int $quantity;

    /**
     * @var string Order status
     */
    private string $status;

    /**
     * @var string Date the product became the current "Status"
     */
    private string $dateStatus;

    /**
     * @var string An individual product can be a different status than the order
     */
    private string $detailedStatus;

    /**
     * @var bool whether the product is an addon or not
     */
    private bool $isAddon;

    /**
     * @var bool whether the product is a trial or not
     */
    private bool $isTrial;

    /**
     * @var string[]
     */
    private array $arrowSubCategories;

    /**
     * @var Prices
     */
    private Prices $prices;

    /**
     * @var Reference
     */
    private Reference $subscription;

    /**
     * @var Reference|null
     */
    private ?Reference $license;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->sku = $data[self::COLUMN_SKU];
        $this->name = $data[self::COLUMN_NAME];
        $this->classification = $data[self::COLUMN_CLASSIFICATION];
        $this->vendorName = $data[self::COLUMN_VENDOR_NAME];
        $this->programName = $data[self::COLUMN_PROGRAM_NAME];
        $this->program = new Program($data[self::COLUMN_PROGRAM]);
        $this->identifiers = new Identifiers($data[self::COLUMN_IDENTIFIERS]);
        $this->quantity = $data[self::COLUMN_QUANTITY];
        $this->status = $data[self::COLUMN_STATUS] ?? '';
        $this->dateStatus = $data[self::COLUMN_DATE_STATUS] ?? '';
        $this->detailedStatus = $data[self::COLUMN_DETAILED_STATUS] ?? '';
        $this->isAddon = $data[self::COLUMN_IS_ADDON] ?? false;
        $this->isTrial = $data[self::COLUMN_IS_TRIAL] ?? false;
        $this->arrowSubCategories = $data[self::COLUMN_ARROW_SUB_CATEGORIES] ?? [];
        $this->prices = new Prices($data[self::COLUMN_PRICES]);
        $this->subscription = new Reference($data[self::COLUMN_SUBSCRIPTION]);
        $this->license = $data[self::COLUMN_LICENSE] ? new Reference($data[self::COLUMN_LICENSE]) : null;
    }

    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_SKU                  => $this->sku,
            self::COLUMN_NAME                 => $this->name,
            self::COLUMN_CLASSIFICATION       => $this->classification,
            self::COLUMN_VENDOR_NAME          => $this->vendorName,
            self::COLUMN_PROGRAM_NAME         => $this->programName,
            self::COLUMN_PROGRAM              => $this->program->jsonSerialize(),
            self::COLUMN_IDENTIFIERS          => $this->identifiers->jsonSerialize(),
            self::COLUMN_QUANTITY             => $this->quantity,
            self::COLUMN_STATUS               => $this->status,
            self::COLUMN_DATE_STATUS          => $this->dateStatus,
            self::COLUMN_DETAILED_STATUS      => $this->detailedStatus,
            self::COLUMN_IS_ADDON             => $this->isAddon,
            self::COLUMN_IS_TRIAL             => $this->isTrial,
            self::COLUMN_ARROW_SUB_CATEGORIES => $this->arrowSubCategories,
            self::COLUMN_PRICES               => $this->prices->jsonSerialize(),
            self::COLUMN_SUBSCRIPTION         => $this->subscription->jsonSerialize(),
            self::COLUMN_LICENSE              => $this->license ? $this->license->jsonSerialize() : null,
        ];
    }

    public function getDateStatus(): string
    {
        return $this->dateStatus;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getClassification(): string
    {
        return $this->classification;
    }

    public function getVendorName(): string
    {
        return $this->vendorName;
    }

    public function getProgramName(): string
    {
        return $this->programName;
    }

    public function getProgram(): Program
    {
        return $this->program;
    }

    public function getIdentifiers(): Identifiers
    {
        return $this->identifiers;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getDetailedStatus(): string
    {
        return $this->detailedStatus;
    }

    public function getIsAddon(): bool
    {
        return $this->isAddon;
    }

    public function getIsTrial(): bool
    {
        return $this->isTrial;
    }

    public function getArrowSubCategories(): array
    {
        return $this->arrowSubCategories;
    }

    public function getPrices(): Prices
    {
        return $this->prices;
    }

    public function getSubscription(): Reference
    {
        return $this->subscription;
    }

    public function getLicense(): ?Reference
    {
        return $this->license;
    }
}
