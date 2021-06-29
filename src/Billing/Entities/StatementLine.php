<?php

namespace ArrowSphere\PublicApiClient\Billing\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Billing\Enum\BillingPeriodicityEnum;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

class StatementLine extends AbstractEntity
{
    public const COLUMN_REFERENCE = 'reference';
    public const COLUMN_VENDOR_END_CUSTOMER_SUBSCRIPTION_ID = 'vendorEndCustomerSubscriptionId';
    public const COLUMN_VENDOR_NAME = 'vendorName';
    public const COLUMN_VENDOR_PROGRAM = 'vendorProgram';
    public const COLUMN_VENDOR_PROGRAM_CLASSIFICATION = 'vendorProgramClassification';
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

    protected const VALIDATION_RULES = parent::VALIDATION_RULES + [
        self::COLUMN_REFERENCE => 'string|required',
        self::COLUMN_VENDOR_END_CUSTOMER_SUBSCRIPTION_ID => 'string|present|nullable',
        self::COLUMN_VENDOR_NAME => 'string|present|nullable',
        self::COLUMN_VENDOR_PROGRAM => 'string|present|nullable',
        self::COLUMN_VENDOR_PROGRAM_CLASSIFICATION => 'string|present|nullable',
        self::COLUMN_VENDOR_PRODUCT_NAME => 'string|present|nullable',
        self::COLUMN_VENDOR_SKU => 'string|present|nullable',
        self::COLUMN_ARROW_SKU => 'string|required',
        self::COLUMN_ORDER_ID => 'string|present|nullable',
        self::COLUMN_RESELLER_ORDER_ID => 'string|present|nullable',
        self::COLUMN_BILLING_PERIOD_START => 'string|present|nullable',
        self::COLUMN_BILLING_PERIOD_END => 'string|present|nullable',
        self::COLUMN_USAGE_START_DATE => 'string|required',
        self::COLUMN_USAGE_END_DATE => 'string|required',
        self::COLUMN_SUBSCRIPTION_START_DATE => 'string|present|nullable',
        self::COLUMN_SUBSCRIPTION_END_DATE => 'string|present|nullable',
        self::COLUMN_BILLING_PERIODICITY => 'string|present|nullable',
        self::COLUMN_QUANTITY => 'numeric|present|nullable',
        self::COLUMN_SUBSCRIPTION_FRIENDLY_NAME => 'string|present|nullable',
        self::COLUMN_ARS_SUBSCRIPTION_ID => 'string|present|nullable',
        self::COLUMN_OFFER_NAME => 'string|present|nullable',
        self::COLUMN_RATES => 'array|required',
        self::COLUMN_CURRENCY => 'string|required',
        self::COLUMN_PRICES => 'array|required',
    ];

    /**
     * @var string
     */
    private $reference;

    /**
     * @var string|null
     */
    private $vendorEndCustomerSubscriptionId;

    /**
     * @var string|null
     */
    private $vendorName;

    /**
     * @var string|null
     */
    private $vendorProgram;

    /**
     * @var string|null
     */
    private $vendorProgramClassification;

    /**
     * @var string|null
     */
    private $vendorProductName;

    /**
     * @var string|null
     */
    private $vendorSku;

    /**
     * @var string
     */
    private $arrowSku;

    /**
     * @var string|null
     */
    private $offerName;

    /**
     * @var string|null
     */
    private $subscriptionFriendlyName;

    /**
     * @var string|null
     */
    private $arsSubscriptionId;

    /**
     * @var string|null
     */
    private $orderId;

    /**
     * @var string|null
     */
    private $resellerOrderId;

    /**
     * @var string|null
     */
    private $subscriptionStartDate;

    /**
     * @var string|null
     */
    private $subscriptionEndDate;

    /**
     * @var string|null
     */
    private $billingPeriodicity;

    /**
     * @var string|null
     */
    private $billingPeriodStart;

    /**
     * @var string|null
     */
    private $billingPeriodEnd;

    /**
     * @var string
     */
    private $usageStartDate;

    /**
     * @var string
     */
    private $usageEndDate;

    /**
     * @var Rates
     */
    private $rates;

    /**
     * @var float|null
     */
    private $quantity;

    /**
     * @var string
     */
    private $currency;

    /**
     * @var Prices
     */
    private $prices;

    /**
     * Statement constructor.
     *
     * @param array $data
     *
     * @throws EntityValidationException
     * @throws \ReflectionException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        if (! BillingPeriodicityEnum::isValidValue($data[self::COLUMN_BILLING_PERIODICITY])) {
            throw new EntityValidationException('Billing periodicity: ' . $data[self::COLUMN_BILLING_PERIODICITY] . ' not supported');
        }

        $this->reference = $data[self::COLUMN_REFERENCE];
        $this->vendorEndCustomerSubscriptionId = $data[self::COLUMN_VENDOR_END_CUSTOMER_SUBSCRIPTION_ID];
        $this->vendorName = $data[self::COLUMN_VENDOR_NAME];
        $this->vendorProgram = $data[self::COLUMN_VENDOR_PROGRAM];
        $this->vendorProgramClassification = $data[self::COLUMN_VENDOR_PROGRAM_CLASSIFICATION];
        $this->vendorProductName = $data[self::COLUMN_VENDOR_PRODUCT_NAME];
        $this->vendorSku = $data[self::COLUMN_VENDOR_SKU];
        $this->arrowSku = $data[self::COLUMN_ARROW_SKU];
        $this->orderId = $data[self::COLUMN_ORDER_ID];
        $this->resellerOrderId = $data[self::COLUMN_RESELLER_ORDER_ID];
        $this->billingPeriodStart = $data[self::COLUMN_BILLING_PERIOD_START];
        $this->billingPeriodEnd = $data[self::COLUMN_BILLING_PERIOD_END];
        $this->usageStartDate = $data[self::COLUMN_USAGE_START_DATE];
        $this->usageEndDate = $data[self::COLUMN_USAGE_END_DATE];
        $this->subscriptionStartDate = $data[self::COLUMN_SUBSCRIPTION_START_DATE];
        $this->subscriptionEndDate = $data[self::COLUMN_SUBSCRIPTION_END_DATE];
        $this->billingPeriodicity = $data[self::COLUMN_BILLING_PERIODICITY];
        $this->subscriptionFriendlyName = $data[self::COLUMN_SUBSCRIPTION_FRIENDLY_NAME];
        $this->arsSubscriptionId = $data[self::COLUMN_ARS_SUBSCRIPTION_ID];
        $this->offerName = $data[self::COLUMN_OFFER_NAME];
        $this->rates = new Rates($data[self::COLUMN_RATES]);
        $this->quantity = $data[self::COLUMN_QUANTITY];
        $this->currency = $data[self::COLUMN_CURRENCY];
        $this->prices = new Prices($data[self::COLUMN_PRICES]);
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
    public function getVendorProgram(): ?string
    {
        return $this->vendorProgram;
    }

    /**
     * @return string|null
     */
    public function getVendorProgramClassification(): ?string
    {
        return $this->vendorProgramClassification;
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
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_REFERENCE => $this->getReference(),
            self::COLUMN_VENDOR_END_CUSTOMER_SUBSCRIPTION_ID => $this->getVendorEndCustomerSubscriptionId(),
            self::COLUMN_VENDOR_NAME => $this->getVendorName(),
            self::COLUMN_VENDOR_PROGRAM => $this->getVendorProgram(),
            self::COLUMN_VENDOR_PROGRAM_CLASSIFICATION => $this->getVendorProgramClassification(),
            self::COLUMN_VENDOR_PRODUCT_NAME => $this->getVendorProductName(),
            self::COLUMN_VENDOR_SKU => $this->getVendorSku(),
            self::COLUMN_ARROW_SKU => $this->getArrowSku(),
            self::COLUMN_OFFER_NAME => $this->getOfferName(),
            self::COLUMN_SUBSCRIPTION_FRIENDLY_NAME => $this->getSubscriptionFriendlyName(),
            self::COLUMN_ARS_SUBSCRIPTION_ID => $this->getArsSubscriptionId(),
            self::COLUMN_ORDER_ID => $this->getOrderId(),
            self::COLUMN_RESELLER_ORDER_ID => $this->getResellerOrderId(),
            self::COLUMN_SUBSCRIPTION_START_DATE => $this->getSubscriptionStartDate(),
            self::COLUMN_SUBSCRIPTION_END_DATE => $this->getSubscriptionEndDate(),
            self::COLUMN_BILLING_PERIODICITY => $this->getBillingPeriodicity(),
            self::COLUMN_BILLING_PERIOD_START => $this->getBillingPeriodStart(),
            self::COLUMN_BILLING_PERIOD_END => $this->getBillingPeriodEnd(),
            self::COLUMN_USAGE_START_DATE => $this->getUsageStartDate(),
            self::COLUMN_USAGE_END_DATE => $this->getUsageEndDate(),
            self::COLUMN_RATES => $this->getRates()->jsonSerialize(),
            self::COLUMN_QUANTITY => $this->getQuantity(),
            self::COLUMN_CURRENCY => $this->getCurrency(),
            self::COLUMN_PRICES => $this->getPrices()->jsonSerialize(),
        ];
    }
}
