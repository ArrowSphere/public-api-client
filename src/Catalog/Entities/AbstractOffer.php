<?php

namespace ArrowSphere\PublicApiClient\Catalog\Entities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Exception\EntitiesException;
use ArrowSphere\PublicApiClient\Entities\Property;

abstract class AbstractOffer extends AbstractEntity
{
    public const COLUMN_CATEGORY = 'category';

    public const COLUMN_CUSTOMER_CATEGORY = 'customer_category';

    public const COLUMN_HAS_ADDONS = 'has_addons';

    public const COLUMN_IS_ADDON = 'is_addon';

    public const COLUMN_ADDONS = 'add_ons';

    public const COLUMN_PREREQUISITES = 'prerequisites';

    public const COLUMN_IS_TRIAL = 'is_trial';

    public const COLUMN_KEYWORDS = 'keywords';

    public const COLUMN_MARKETPLACE = 'marketplace';

    public const COLUMN_NAME = 'name';

    public const COLUMN_SERVICE_NAME = 'service_name';

    public const COLUMN_SERVICE_REF = 'service_ref';

    public const COLUMN_SKU = 'sku';

    public const COLUMN_THUMBNAIL = 'thumbnail';

    public const COLUMN_TYPE = 'type';

    public const COLUMN_VENDOR = 'vendor';

    public const COLUMN_VENDOR_CODE = 'vendor_code';

    public const COLUMN_WEIGHT_FORCED = 'weight_forced';

    public const COLUMN_WEIGHT_TOP_SALES = 'weight_top_sales';

    /**
     * @var string[]|null
     */
    #[Property(name: self::COLUMN_ADDONS, isArray: true, serializeNull: true)]
    protected ?array $addons = null;

    /**
     * @var string[]
     */
    #[Property(name: self::COLUMN_CATEGORY, type: 'array')]
    protected array $category = [];

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_TYPE, required: true)]
    protected string $classification;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_CUSTOMER_CATEGORY, required: true)]
    protected string $customerCategory;

    /**
     * @var bool
     */
    #[Property(name: self::COLUMN_HAS_ADDONS, type: 'bool', required: true)]
    protected bool $hasAddons;

    /**
     * @var bool
     */
    #[Property(name: self::COLUMN_IS_ADDON, type: 'bool', required: true)]
    protected bool $isAddon;

    /**
     * @var bool
     */
    #[Property(name: self::COLUMN_IS_TRIAL, type: 'bool', required: true)]
    protected bool $isTrial;

    /**
     * @var string[]
     */
    #[Property(name: self::COLUMN_KEYWORDS, type: 'array')]
    protected array $keywords = [];

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
     * @var string[]|null
     */
    #[Property(name: self::COLUMN_PREREQUISITES, isArray: true, serializeNull: true)]
    protected ?array $prerequisites = null;

    /**
     * @var PriceBand[]
     */
    #[Property(name: 'prices', type: PriceBand::class, isArray: true)]
    protected array $priceBands = [];

    /**
     * @var bool The nested program.isEnabled field, hydrated by the constructor
     */
    protected bool $programIsEnabled = true;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_SERVICE_NAME, required: true)]
    protected string $serviceName;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_SERVICE_REF, required: true)]
    protected string $serviceRef;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_SKU, required: true)]
    protected string $sku;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_THUMBNAIL, required: true)]
    protected string $thumbnail;

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
     * @var float
     */
    #[Property(name: self::COLUMN_WEIGHT_FORCED, type: 'float', required: true)]
    protected float $weightForced;

    /**
     * @var float
     */
    #[Property(name: self::COLUMN_WEIGHT_TOP_SALES, type: 'float', required: true)]
    protected float $weightTopSales;

    /**
     * AbstractOffer constructor.
     *
     * @param array $data
     *
     * @throws EntitiesException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        /** @var array{program?: array{isEnabled?: bool|null}, add_ons?: array, prerequisites?: array} $data */
        $this->programIsEnabled = (bool) ($data['program']['isEnabled'] ?? true);

        // An empty list stays an empty list, the attribute hydration would consider it as missing
        if (($data[self::COLUMN_ADDONS] ?? null) === []) {
            $this->addons = [];
        }

        if (($data[self::COLUMN_PREREQUISITES] ?? null) === []) {
            $this->prerequisites = [];
        }

        $this->sortBandsByBillingCycle();
    }

    /**
     * @return array
     */
    public function getCategory(): array
    {
        return $this->category;
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
    public function getCustomerCategory(): string
    {
        return $this->customerCategory;
    }

    /**
     * @return bool
     */
    public function getHasAddons(): bool
    {
        return $this->hasAddons;
    }

    /**
     * @return string[]|null
     */
    public function getAddons(): ?array
    {
        return $this->addons;
    }

    /**
     * @return string[]|null
     */
    public function getPrerequisites(): ?array
    {
        return $this->prerequisites;
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
    public function getKeywords(): array
    {
        return $this->keywords;
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
     * @return PriceBand[]
     */
    public function getPriceBands(): array
    {
        return $this->priceBands;
    }

    /**
     * @return bool
     */
    public function getProgramIsEnabled(): bool
    {
        return $this->programIsEnabled;
    }

    /**
     * @return string
     */
    public function getServiceName(): string
    {
        return $this->serviceName;
    }

    /**
     * @return string
     */
    public function getServiceRef(): string
    {
        return $this->serviceRef;
    }

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
    public function getThumbnail(): string
    {
        return $this->thumbnail;
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
     * @return float
     */
    public function getWeightForced(): float
    {
        return $this->weightForced;
    }

    /**
     * @return float
     */
    public function getWeightTopSales(): float
    {
        return $this->weightTopSales;
    }

    /**
     * Returns the default priceband of the offer, which means the one with the lowest quantity and "period as hours".
     *
     * @return PriceBand|null
     */
    public function getDefaultPriceBand(): ?PriceBand
    {
        if (count($this->priceBands) === 0) {
            return null;
        }

        return $this->priceBands[0];
    }

    /**
     * Returns all the possible terms for this offer, as an array of number of hours.
     *
     * @return string[]
     */
    public function getAllTermsBand(): array
    {
        $terms = [];

        foreach ($this->priceBands as $priceBand) {
            $terms[$priceBand->getTermAsHours()] = $priceBand->getTerm();
        }

        return $terms;
    }

    /**
     * Returns all available billing cycles in an array indexed by term.
     *
     * @return array
     */
    public function getBillingCyclesByTerm(): array
    {
        $billingCyclesByTerm = [];

        foreach ($this->priceBands as $priceBand) {
            $billingCyclesByTerm[$priceBand->getTermAsHours()][$priceBand->getPeriodAsHours()] = $priceBand->getRecurringTimeUnit();
        }

        return $billingCyclesByTerm;
    }

    /**
     * Sorts the pricebands by billing cycle, then by minimum quantity.
     */
    private function sortBandsByBillingCycle(): void
    {
        // This nonsensical algorithm is here to sort the pricebands first by term, then by min quantity
        uasort($this->priceBands, static function (PriceBand $bandA, PriceBand $bandB) {
            $checkTimeUnit = $bandA->getTermAsHours() <=> $bandB->getTermAsHours();

            return $checkTimeUnit === 0 ? $bandA->getMinQuantity() <=> $bandB->getMinQuantity() : $checkTimeUnit;
        });
    }
}
