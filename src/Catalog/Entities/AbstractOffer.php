<?php

namespace ArrowSphere\PublicApiClient\Catalog\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

abstract class AbstractOffer extends AbstractEntity
{
    public const COLUMN_CATEGORY = 'category';

    public const COLUMN_CUSTOMER_CATEGORY = 'customer_category';

    public const COLUMN_HAS_ADDONS = 'has_addons';

    public const COLUMN_IS_ADDON = 'is_addon';

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

    protected const VALIDATION_RULES = [
        self::COLUMN_CATEGORY          => 'present|array',
        self::COLUMN_CUSTOMER_CATEGORY => 'present',
        self::COLUMN_HAS_ADDONS        => 'required',
        self::COLUMN_IS_ADDON          => 'required',
        self::COLUMN_IS_TRIAL          => 'required',
        self::COLUMN_KEYWORDS          => 'present|array',
        self::COLUMN_MARKETPLACE       => 'required',
        self::COLUMN_NAME              => 'required',
        'prices'                       => 'required|array',
        self::COLUMN_SERVICE_NAME      => 'present',
        self::COLUMN_SERVICE_REF       => 'required',
        self::COLUMN_SKU               => 'required',
        self::COLUMN_THUMBNAIL         => 'present',
        self::COLUMN_TYPE              => 'required',
        self::COLUMN_VENDOR            => 'required',
        self::COLUMN_VENDOR_CODE       => 'required',
        self::COLUMN_WEIGHT_FORCED     => 'required|numeric',
        self::COLUMN_WEIGHT_TOP_SALES  => 'required|numeric',
    ];

    /** @var string[] */
    private $category;

    /** @var string */
    private $classification;

    /** @var string */
    private $customerCategory;

    /** @var bool */
    private $hasAddons;

    /** @var bool */
    private $isAddon;

    /** @var bool */
    private $isTrial;

    /** @var string[] */
    private $keywords;

    /** @var string */
    private $marketplace;

    /** @var string */
    private $name;

    /** @var PriceBand[] */
    private $priceBands;

    /** @var bool */
    private $programIsEnabled;

    /** @var string */
    private $serviceName;

    /** @var string */
    private $serviceRef;

    /** @var string */
    private $sku;

    /** @var string */
    private $thumbnail;

    /** @var string */
    private $vendor;

    /** @var string */
    private $vendorCode;

    /** @var float */
    private $weightForced;

    /** @var float */
    private $weightTopSales;

    /**
     * AbstractOffer constructor.
     *
     * @param array $data
     * @throws EntityValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->category = $data[self::COLUMN_CATEGORY];
        $this->classification = $data[self::COLUMN_TYPE];
        $this->customerCategory = $data[self::COLUMN_CUSTOMER_CATEGORY];
        $this->hasAddons = $data[self::COLUMN_HAS_ADDONS];
        $this->isAddon = $data[self::COLUMN_IS_ADDON];
        $this->isTrial = $data[self::COLUMN_IS_TRIAL];
        $this->keywords = $data[self::COLUMN_KEYWORDS];
        $this->marketplace = $data[self::COLUMN_MARKETPLACE];
        $this->name = $data[self::COLUMN_NAME];
        $this->priceBands = array_map(static function (array $priceBandData) {
            return new PriceBand($priceBandData);
        }, $data['prices']);
        $this->programIsEnabled = $data['program']['isEnabled'] ?? true;
        $this->serviceName = $data[self::COLUMN_SERVICE_NAME];
        $this->serviceRef = $data[self::COLUMN_SERVICE_REF];
        $this->sku = $data[self::COLUMN_SKU];
        $this->thumbnail = $data[self::COLUMN_THUMBNAIL];
        $this->vendor = $data[self::COLUMN_VENDOR];
        $this->vendorCode = $data[self::COLUMN_VENDOR_CODE];
        $this->weightForced = $data[self::COLUMN_WEIGHT_FORCED];
        $this->weightTopSales = $data[self::COLUMN_WEIGHT_TOP_SALES];

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
     * @return int[]
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

    public function jsonSerialize()
    {
        return [
            self::COLUMN_CATEGORY          => $this->getCategory(),
            self::COLUMN_CUSTOMER_CATEGORY => $this->getCustomerCategory(),
            self::COLUMN_HAS_ADDONS        => $this->getHasAddons(),
            self::COLUMN_IS_ADDON          => $this->getIsAddon(),
            self::COLUMN_IS_TRIAL          => $this->getIsTrial(),
            self::COLUMN_KEYWORDS          => $this->getKeywords(),
            self::COLUMN_MARKETPLACE       => $this->getMarketplace(),
            self::COLUMN_NAME              => $this->getName(),
            self::COLUMN_SERVICE_NAME      => $this->getServiceName(),
            self::COLUMN_SERVICE_REF       => $this->getServiceRef(),
            self::COLUMN_SKU               => $this->getSku(),
            self::COLUMN_THUMBNAIL         => $this->getThumbnail(),
            self::COLUMN_TYPE              => $this->getClassification(),
            self::COLUMN_VENDOR            => $this->getVendor(),
            self::COLUMN_VENDOR_CODE       => $this->getVendorCode(),
            self::COLUMN_WEIGHT_FORCED     => $this->getWeightForced(),
            self::COLUMN_WEIGHT_TOP_SALES  => $this->getWeightTopSales(),
            'prices'                       => $this->getPriceBands()
        ];
    }
}
