<?php

namespace ArrowSphere\PublicApiClient\Billing\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity as LegacyAbstractEntity;
use ArrowSphere\PublicApiClient\Billing\Enum\BillingPeriodicityEnum;
use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Exception\EntitiesException;
use ArrowSphere\PublicApiClient\Entities\Property;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

class StatementLine extends AbstractEntity
{
    public const COLUMN_REFERENCE = 'reference';
    public const COLUMN_VENDOR_END_CUSTOMER_SUBSCRIPTION_ID = 'vendorEndCustomerSubscriptionId';
    public const COLUMN_VENDOR_NAME = 'vendorName';
    public const COLUMN_PROGRAM_CODE = 'programCode';
    public const COLUMN_CLASSIFICATION = 'classification';
    public const COLUMN_VENDOR_PRODUCT_NAME = 'vendorProductName';
    public const COLUMN_VENDOR_SKU = 'vendorSku';
    public const COLUMN_ARROW_SKU = 'arrowSku';
    public const COLUMN_OFFER_NAME = 'offerName';
    public const COLUMN_SUBSCRIPTION_FRIENDLY_NAME = 'subscriptionFriendlyName';
    public const COLUMN_ARS_SUBSCRIPTION_ID = 'arsSubscriptionId';
    public const COLUMN_ORDER_ID = 'orderId';
    public const COLUMN_RESELLER_ORDER_ID = 'resellerOrderId';
    public const COLUMN_SUBSCRIPTION_START_DATE = 'subscriptionStartDate';
    public const COLUMN_SUBSCRIPTION_END_DATE = 'subscriptionEndDate';
    public const COLUMN_BILLING_PERIODICITY = 'billingPeriodicity';
    public const COLUMN_BILLING_PERIOD_START = 'billingPeriodStart';
    public const COLUMN_BILLING_PERIOD_END = 'billingPeriodEnd';
    public const COLUMN_USAGE_START_DATE = 'usageStartDate';
    public const COLUMN_USAGE_END_DATE = 'usageEndDate';
    public const COLUMN_RATES = 'rates';
    public const COLUMN_QUANTITY = 'quantity';
    public const COLUMN_CURRENCY = 'currency';
    public const COLUMN_PRICES = 'prices';
    public const COLUMN_DESCRIPTION = 'description';

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_REFERENCE, required: true)]
    protected string $reference;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_VENDOR_END_CUSTOMER_SUBSCRIPTION_ID, serializeNull: true)]
    protected ?string $vendorEndCustomerSubscriptionId = null;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_VENDOR_NAME, serializeNull: true)]
    protected ?string $vendorName = null;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_PROGRAM_CODE, serializeNull: true)]
    protected ?string $programCode = null;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_CLASSIFICATION, serializeNull: true)]
    protected ?string $classification = null;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_VENDOR_PRODUCT_NAME, serializeNull: true)]
    protected ?string $vendorProductName = null;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_VENDOR_SKU, serializeNull: true)]
    protected ?string $vendorSku = null;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_ARROW_SKU, required: true)]
    protected string $arrowSku;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_OFFER_NAME, serializeNull: true)]
    protected ?string $offerName = null;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_SUBSCRIPTION_FRIENDLY_NAME, serializeNull: true)]
    protected ?string $subscriptionFriendlyName = null;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_ARS_SUBSCRIPTION_ID, serializeNull: true)]
    protected ?string $arsSubscriptionId = null;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_ORDER_ID, serializeNull: true)]
    protected ?string $orderId = null;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_RESELLER_ORDER_ID, serializeNull: true)]
    protected ?string $resellerOrderId = null;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_SUBSCRIPTION_START_DATE, serializeNull: true)]
    protected ?string $subscriptionStartDate = null;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_SUBSCRIPTION_END_DATE, serializeNull: true)]
    protected ?string $subscriptionEndDate = null;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_BILLING_PERIODICITY, serializeNull: true)]
    protected ?string $billingPeriodicity = null;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_BILLING_PERIOD_START, serializeNull: true)]
    protected ?string $billingPeriodStart = null;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_BILLING_PERIOD_END, serializeNull: true)]
    protected ?string $billingPeriodEnd = null;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_USAGE_START_DATE, required: true)]
    protected string $usageStartDate;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_USAGE_END_DATE, required: true)]
    protected string $usageEndDate;

    /**
     * @var Rates
     */
    #[Property(name: self::COLUMN_RATES, type: Rates::class, required: true)]
    protected Rates $rates;

    /**
     * @var float|null
     */
    #[Property(name: self::COLUMN_QUANTITY, type: 'float', serializeNull: true)]
    protected ?float $quantity = null;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_CURRENCY, required: true)]
    protected string $currency;

    /**
     * @var Prices
     */
    #[Property(name: self::COLUMN_PRICES, type: Prices::class, required: true)]
    protected Prices $prices;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_DESCRIPTION, serializeNull: true)]
    protected ?string $description = null;

    /**
     * StatementLine constructor.
     *
     * @param array $data
     *
     * @throws EntitiesException
     * @throws EntityValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        if (LegacyAbstractEntity::$enableValidation && ! BillingPeriodicityEnum::isValidValue($this->billingPeriodicity)) {
            throw new EntityValidationException('Billing periodicity: ' . $this->billingPeriodicity . ' not supported');
        }
    }

    /**
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * @return string|null
     */
    public function getVendorEndCustomerSubscriptionId(): ?string
    {
        return $this->vendorEndCustomerSubscriptionId;
    }

    /**
     * @return string|null
     */
    public function getVendorName(): ?string
    {
        return $this->vendorName;
    }

    /**
     * @return string|null
     */
    public function getProgramCode(): ?string
    {
        return $this->programCode;
    }

    /**
     * @return string|null
     */
    public function getClassification(): ?string
    {
        return $this->classification;
    }

    /**
     * @return string|null
     */
    public function getVendorProductName(): ?string
    {
        return $this->vendorProductName;
    }

    /**
     * @return string|null
     */
    public function getVendorSku(): ?string
    {
        return $this->vendorSku;
    }

    /**
     * @return string
     */
    public function getArrowSku(): string
    {
        return $this->arrowSku;
    }

    /**
     * @return string|null
     */
    public function getOfferName(): ?string
    {
        return $this->offerName;
    }

    /**
     * @return string|null
     */
    public function getSubscriptionFriendlyName(): ?string
    {
        return $this->subscriptionFriendlyName;
    }

    /**
     * @return string|null
     */
    public function getArsSubscriptionId(): ?string
    {
        return $this->arsSubscriptionId;
    }

    /**
     * @return string|null
     */
    public function getOrderId(): ?string
    {
        return $this->orderId;
    }

    /**
     * @return string|null
     */
    public function getResellerOrderId(): ?string
    {
        return $this->resellerOrderId;
    }

    /**
     * @return string|null
     */
    public function getSubscriptionStartDate(): ?string
    {
        return $this->subscriptionStartDate;
    }

    /**
     * @return string|null
     */
    public function getSubscriptionEndDate(): ?string
    {
        return $this->subscriptionEndDate;
    }

    /**
     * @return string|null
     */
    public function getBillingPeriodicity(): ?string
    {
        return $this->billingPeriodicity;
    }

    /**
     * @return string|null
     */
    public function getBillingPeriodStart(): ?string
    {
        return $this->billingPeriodStart;
    }

    /**
     * @return string|null
     */
    public function getBillingPeriodEnd(): ?string
    {
        return $this->billingPeriodEnd;
    }

    /**
     * @return string
     */
    public function getUsageStartDate(): string
    {
        return $this->usageStartDate;
    }

    /**
     * @return string
     */
    public function getUsageEndDate(): string
    {
        return $this->usageEndDate;
    }

    /**
     * @return Rates
     */
    public function getRates(): Rates
    {
        return $this->rates;
    }

    /**
     * @return float|null
     */
    public function getQuantity(): ?float
    {
        return $this->quantity;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @return Prices
     */
    public function getPrices(): Prices
    {
        return $this->prices;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }
}
