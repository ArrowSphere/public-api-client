<?php

namespace ArrowSphere\PublicApiClient\Billing\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Billing\Enum\BillingPeriodicityEnum;
use ArrowSphere\PublicApiClient\Billing\Enum\RateTypeEnum;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

class StatementLine extends AbstractEntity
{
    public const COLUMN_REFERENCE = 'reference';
    public const COLUMN_VENDOR_END_CUSTOMER_SUBSCRIPTION_ID = 'vendorEndCustomerSubscriptionId';
    public const COLUMN_RESELLER_BILLING_TAG = 'resellerBillingTag';
    public const COLUMN_VENDOR_NAME = 'vendorName';
    public const COLUMN_VENDOR_PROGRAM = 'vendorProgram';
    public const COLUMN_VENDOR_PROGRAM_CLASSIFICATION = 'vendorProgramClassification';
    public const COLUMN_VENDOR_PRODUCT_NAME = 'vendorProductName';
    public const COLUMN_SERVICE_CODE = 'serviceCode';
    public const COLUMN_VENDOR_SKU = 'vendorSku';
    public const COLUMN_ARROW_SKU = 'arrowSku';
    public const COLUMN_ORDER_ID = 'orderId';
    public const COLUMN_RESELLER_ORDER_ID = 'resellerOrderId';
    public const COLUMN_BILLING_PERIOD_START = 'billingPeriodStart';
    public const COLUMN_BILLING_PERIOD_END = 'billingPeriodEnd';
    public const COLUMN_USAGE_START_DATE = 'usageStartDate';
    public const COLUMN_USAGE_END_DATE = 'usageEndDate';
    public const COLUMN_SUBSCRIPTION_START_DATE = 'subscriptionStartDate';
    public const COLUMN_SUBSCRIPTION_END_DATE = 'subscriptionEndDate';
    public const COLUMN_BILLING_PERIODICITY = 'billingPeriodicity';
    public const COLUMN_QUANTITY = 'quantity';
    public const COLUMN_SUBSCRIPTION_FRIENDLY_NAME = 'subscriptionFriendlyName';
    public const COLUMN_ARS_SUBSCRIPTION_ID = 'arsSubscriptionId';
    public const COLUMN_OFFER_NAME = 'offerName';
    public const COLUMN_EXCHANGE_RATE = 'exchangeRate';
    public const COLUMN_END_CUSTOMER_RATE = 'endCustomerRate';
    public const COLUMN_END_CUSTOMER_RATE_TYPE = 'endCustomerRateType';
    public const COLUMN_VENDOR_CURRENCY = 'vendorCurrency';
    public const COLUMN_VENDOR_RETAIL_UNIT_BUY_PRICE = 'vendorRetailUnitBuyPrice';
    public const COLUMN_VENDOR_RETAIL_TOTAL_BUY_PRICE = 'vendorRetailTotalBuyPrice';
    public const COLUMN_VENDOR_RESELLER_UNIT_BUY_PRICE = 'vendorResellerUnitBuyPrice';
    public const COLUMN_VENDOR_RESELLER_TOTAL_BUY_PRICE = 'vendorResellerTotalBuyPrice';
    public const COLUMN_VENDOR_END_CUSTOMER_UNIT_BUY_PRICE = 'vendorEndCustomerUnitBuyPrice';
    public const COLUMN_VENDOR_END_CUSTOMER_TOTAL_BUY_PRICE = 'vendorEndCustomerTotalBuyPrice';
    public const COLUMN_COUNTRY_CURRENCY = 'countryCurrency';
    public const COLUMN_COUNTRY_RETAIL_UNIT_BUY_PRICE = 'countryRetailUnitBuyPrice';
    public const COLUMN_COUNTRY_RETAIL_TOTAL_BUY_PRICE = 'countryRetailTotalBuyPrice';
    public const COLUMN_COUNTRY_RESELLER_UNIT_BUY_PRICE = 'countryResellerUnitBuyPrice';
    public const COLUMN_COUNTRY_RESELLER_TOTAL_BUY_PRICE = 'countryResellerTotalBuyPrice';
    public const COLUMN_COUNTRY_END_CUSTOMER_UNIT_BUY_PRICE = 'countryEndCustomerUnitBuyPrice';
    public const COLUMN_COUNTRY_END_CUSTOMER_TOTAL_BUY_PRICE = 'countryEndCustomerTotalBuyPrice';

    protected const VALIDATION_RULES = parent::VALIDATION_RULES + [
        self::COLUMN_REFERENCE => 'string|required',
        self::COLUMN_VENDOR_END_CUSTOMER_SUBSCRIPTION_ID => 'string|present|nullable',
        self::COLUMN_RESELLER_BILLING_TAG => 'string|present|nullable',
        self::COLUMN_VENDOR_NAME => 'string|present|nullable',
        self::COLUMN_VENDOR_PROGRAM => 'string|present|nullable',
        self::COLUMN_VENDOR_PROGRAM_CLASSIFICATION => 'string|present|nullable',
        self::COLUMN_VENDOR_PRODUCT_NAME => 'string|present|nullable',
        self::COLUMN_SERVICE_CODE => 'string|present|nullable',
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
        self::COLUMN_EXCHANGE_RATE => 'numeric|present|nullable',
        self::COLUMN_END_CUSTOMER_RATE => 'numeric|present|nullable',
        self::COLUMN_END_CUSTOMER_RATE_TYPE => 'string|present|nullable',
        self::COLUMN_VENDOR_CURRENCY => 'string|present|nullable',
        self::COLUMN_VENDOR_RETAIL_UNIT_BUY_PRICE => 'numeric|present|nullable',
        self::COLUMN_VENDOR_RETAIL_TOTAL_BUY_PRICE => 'numeric|required',
        self::COLUMN_VENDOR_RESELLER_UNIT_BUY_PRICE => 'numeric|present|nullable',
        self::COLUMN_VENDOR_RESELLER_TOTAL_BUY_PRICE => 'numeric|required',
        self::COLUMN_VENDOR_END_CUSTOMER_UNIT_BUY_PRICE => 'numeric|present|nullable',
        self::COLUMN_VENDOR_END_CUSTOMER_TOTAL_BUY_PRICE => 'numeric|required',
        self::COLUMN_COUNTRY_CURRENCY => 'string|required',
        self::COLUMN_COUNTRY_RETAIL_UNIT_BUY_PRICE => 'numeric|present|nullable',
        self::COLUMN_COUNTRY_RETAIL_TOTAL_BUY_PRICE => 'numeric|required',
        self::COLUMN_COUNTRY_RESELLER_UNIT_BUY_PRICE => 'numeric|present|nullable',
        self::COLUMN_COUNTRY_RESELLER_TOTAL_BUY_PRICE => 'numeric|required',
        self::COLUMN_COUNTRY_END_CUSTOMER_UNIT_BUY_PRICE => 'numeric|present|nullable',
        self::COLUMN_COUNTRY_END_CUSTOMER_TOTAL_BUY_PRICE => 'numeric|required',
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
    private $resellerBillingTag;

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
    private $serviceCode;

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
    private $orderId;

    /**
     * @var string|null
     */
    private $resellerOrderId;

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
     * @var float|null
     */
    private $quantity;

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
    private $offerName;

    /**
     * @var float|null
     */
    private $exchangeRate;

    /**
     * @var float|null
     */
    private $endCustomerRate;

    /**
     * @var string|null
     */
    private $endCustomerRateType;

    /**
     * @var string|null
     */
    private $vendorCurrency;

    /**
     * @var float|null
     */
    private $vendorRetailUnitBuyPrice;

    /**
     * @var float
     */
    private $vendorRetailTotalBuyPrice;

    /**
     * @var float|null
     */
    private $vendorResellerUnitBuyPrice;

    /**
     * @var float
     */
    private $vendorResellerTotalBuyPrice;

    /**
     * @var float|null
     */
    private $vendorEndCustomerUnitBuyPrice;

    /**
     * @var float
     */
    private $vendorEndCustomerTotalBuyPrice;

    /**
     * @var string
     */
    private $countryCurrency;

    /**
     * @var float|null
     */
    private $countryRetailUnitBuyPrice;

    /**
     * @var float
     */
    private $countryRetailTotalBuyPrice;

    /**
     * @var float|null
     */
    private $countryResellerUnitBuyPrice;

    /**
     * @var float
     */
    private $countryResellerTotalBuyPrice;

    /**
     * @var float|null
     */
    private $countryEndCustomerUnitBuyPrice;

    /**
     * @var float
     */
    private $countryEndCustomerTotalBuyPrice;

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

        if (! RateTypeEnum::isValidValue($data[self::COLUMN_END_CUSTOMER_RATE_TYPE])) {
            throw new EntityValidationException('End Customer Rate type: ' . $data[self::COLUMN_END_CUSTOMER_RATE_TYPE] . ' not supported');
        }

        if (! BillingPeriodicityEnum::isValidValue($data[self::COLUMN_BILLING_PERIODICITY])) {
            throw new EntityValidationException('Billing periodicity: ' . $data[self::COLUMN_BILLING_PERIODICITY] . ' not supported');
        }

        $this->reference = $data[self::COLUMN_REFERENCE];
        $this->vendorEndCustomerSubscriptionId = $data[self::COLUMN_VENDOR_END_CUSTOMER_SUBSCRIPTION_ID];
        $this->resellerBillingTag = $data[self::COLUMN_RESELLER_BILLING_TAG];
        $this->vendorName = $data[self::COLUMN_VENDOR_NAME];
        $this->vendorProgram = $data[self::COLUMN_VENDOR_PROGRAM];
        $this->vendorProgramClassification = $data[self::COLUMN_VENDOR_PROGRAM_CLASSIFICATION];
        $this->vendorProductName = $data[self::COLUMN_VENDOR_PRODUCT_NAME];
        $this->serviceCode = $data[self::COLUMN_SERVICE_CODE];
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
        $this->quantity = $data[self::COLUMN_QUANTITY];
        $this->subscriptionFriendlyName = $data[self::COLUMN_SUBSCRIPTION_FRIENDLY_NAME];
        $this->arsSubscriptionId = $data[self::COLUMN_ARS_SUBSCRIPTION_ID];
        $this->offerName = $data[self::COLUMN_OFFER_NAME];
        $this->exchangeRate = $data[self::COLUMN_EXCHANGE_RATE];
        $this->endCustomerRate = $data[self::COLUMN_END_CUSTOMER_RATE];
        $this->endCustomerRateType = $data[self::COLUMN_END_CUSTOMER_RATE_TYPE];
        $this->vendorCurrency = $data[self::COLUMN_VENDOR_CURRENCY];
        $this->vendorRetailUnitBuyPrice = $data[self::COLUMN_VENDOR_RETAIL_UNIT_BUY_PRICE];
        $this->vendorRetailTotalBuyPrice = $data[self::COLUMN_VENDOR_RETAIL_TOTAL_BUY_PRICE];
        $this->vendorResellerUnitBuyPrice = $data[self::COLUMN_VENDOR_RESELLER_UNIT_BUY_PRICE];
        $this->vendorResellerTotalBuyPrice = $data[self::COLUMN_VENDOR_RESELLER_TOTAL_BUY_PRICE];
        $this->vendorEndCustomerUnitBuyPrice = $data[self::COLUMN_VENDOR_END_CUSTOMER_UNIT_BUY_PRICE];
        $this->vendorEndCustomerTotalBuyPrice = $data[self::COLUMN_VENDOR_END_CUSTOMER_TOTAL_BUY_PRICE];
        $this->countryCurrency = $data[self::COLUMN_COUNTRY_CURRENCY];
        $this->countryRetailUnitBuyPrice = $data[self::COLUMN_COUNTRY_RETAIL_UNIT_BUY_PRICE];
        $this->countryRetailTotalBuyPrice = $data[self::COLUMN_COUNTRY_RETAIL_TOTAL_BUY_PRICE];
        $this->countryResellerUnitBuyPrice = $data[self::COLUMN_COUNTRY_RESELLER_UNIT_BUY_PRICE];
        $this->countryResellerTotalBuyPrice = $data[self::COLUMN_COUNTRY_RESELLER_TOTAL_BUY_PRICE];
        $this->countryEndCustomerUnitBuyPrice = $data[self::COLUMN_COUNTRY_END_CUSTOMER_UNIT_BUY_PRICE];
        $this->countryEndCustomerTotalBuyPrice = $data[self::COLUMN_COUNTRY_END_CUSTOMER_TOTAL_BUY_PRICE];
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
    public function getResellerBillingTag(): ?string
    {
        return $this->resellerBillingTag;
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
    public function getServiceCode(): ?string
    {
        return $this->serviceCode;
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
     * @return float|null
     */
    public function getQuantity(): ?float
    {
        return $this->quantity;
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
    public function getOfferName(): ?string
    {
        return $this->offerName;
    }

    /**
     * @return float|null
     */
    public function getExchangeRate(): ?float
    {
        return $this->exchangeRate;
    }

    /**
     * @return float|null
     */
    public function getEndCustomerRate(): ?float
    {
        return $this->endCustomerRate;
    }

    /**
     * @return string|null
     */
    public function getEndCustomerRateType(): ?string
    {
        return $this->endCustomerRateType;
    }

    /**
     * @return string|null
     */
    public function getVendorCurrency(): ?string
    {
        return $this->vendorCurrency;
    }

    /**
     * @return float|null
     */
    public function getVendorRetailUnitBuyPrice(): ?float
    {
        return $this->vendorRetailUnitBuyPrice;
    }

    /**
     * @return float
     */
    public function getVendorRetailTotalBuyPrice(): float
    {
        return $this->vendorRetailTotalBuyPrice;
    }

    /**
     * @return float|null
     */
    public function getVendorResellerUnitBuyPrice(): ?float
    {
        return $this->vendorResellerUnitBuyPrice;
    }

    /**
     * @return float
     */
    public function getVendorResellerTotalBuyPrice(): float
    {
        return $this->vendorResellerTotalBuyPrice;
    }

    /**
     * @return float|null
     */
    public function getVendorEndCustomerUnitBuyPrice(): ?float
    {
        return $this->vendorEndCustomerUnitBuyPrice;
    }

    /**
     * @return float
     */
    public function getVendorEndCustomerTotalBuyPrice(): float
    {
        return $this->vendorEndCustomerTotalBuyPrice;
    }

    /**
     * @return string
     */
    public function getCountryCurrency(): string
    {
        return $this->countryCurrency;
    }

    /**
     * @return float|null
     */
    public function getCountryRetailUnitBuyPrice(): ?float
    {
        return $this->countryRetailUnitBuyPrice;
    }

    /**
     * @return float
     */
    public function getCountryRetailTotalBuyPrice(): float
    {
        return $this->countryRetailTotalBuyPrice;
    }

    /**
     * @return float|null
     */
    public function getCountryResellerUnitBuyPrice(): ?float
    {
        return $this->countryResellerUnitBuyPrice;
    }

    /**
     * @return float
     */
    public function getCountryResellerTotalBuyPrice(): float
    {
        return $this->countryResellerTotalBuyPrice;
    }

    /**
     * @return float|null
     */
    public function getCountryEndCustomerUnitBuyPrice(): ?float
    {
        return $this->countryEndCustomerUnitBuyPrice;
    }

    /**
     * @return float
     */
    public function getCountryEndCustomerTotalBuyPrice(): float
    {
        return $this->countryEndCustomerTotalBuyPrice;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_REFERENCE => $this->getReference(),
            self::COLUMN_VENDOR_END_CUSTOMER_SUBSCRIPTION_ID => $this->getVendorEndCustomerSubscriptionId(),
            self::COLUMN_RESELLER_BILLING_TAG => $this->getResellerBillingTag(),
            self::COLUMN_VENDOR_NAME => $this->getVendorName(),
            self::COLUMN_VENDOR_PROGRAM => $this->getVendorProgram(),
            self::COLUMN_VENDOR_PROGRAM_CLASSIFICATION => $this->getVendorProgramClassification(),
            self::COLUMN_VENDOR_PRODUCT_NAME => $this->getVendorProductName(),
            self::COLUMN_SERVICE_CODE => $this->getServiceCode(),
            self::COLUMN_VENDOR_SKU => $this->getVendorSku(),
            self::COLUMN_ARROW_SKU => $this->getArrowSku(),
            self::COLUMN_ORDER_ID => $this->getOrderId(),
            self::COLUMN_RESELLER_ORDER_ID => $this->getResellerOrderId(),
            self::COLUMN_BILLING_PERIOD_START => $this->getBillingPeriodStart(),
            self::COLUMN_BILLING_PERIOD_END => $this->getBillingPeriodEnd(),
            self::COLUMN_USAGE_START_DATE => $this->getUsageStartDate(),
            self::COLUMN_USAGE_END_DATE => $this->getUsageEndDate(),
            self::COLUMN_SUBSCRIPTION_START_DATE => $this->getSubscriptionStartDate(),
            self::COLUMN_SUBSCRIPTION_END_DATE => $this->getSubscriptionEndDate(),
            self::COLUMN_BILLING_PERIODICITY => $this->getBillingPeriodicity(),
            self::COLUMN_QUANTITY => $this->getQuantity(),
            self::COLUMN_SUBSCRIPTION_FRIENDLY_NAME => $this->getSubscriptionFriendlyName(),
            self::COLUMN_ARS_SUBSCRIPTION_ID => $this->getArsSubscriptionId(),
            self::COLUMN_OFFER_NAME => $this->getOfferName(),
            self::COLUMN_EXCHANGE_RATE => $this->getExchangeRate(),
            self::COLUMN_END_CUSTOMER_RATE => $this->getEndCustomerRate(),
            self::COLUMN_END_CUSTOMER_RATE_TYPE => $this->getEndCustomerRateType(),
            self::COLUMN_VENDOR_CURRENCY => $this->getVendorCurrency(),
            self::COLUMN_VENDOR_RETAIL_UNIT_BUY_PRICE => $this->getVendorRetailUnitBuyPrice(),
            self::COLUMN_VENDOR_RETAIL_TOTAL_BUY_PRICE => $this->getVendorRetailTotalBuyPrice(),
            self::COLUMN_VENDOR_RESELLER_UNIT_BUY_PRICE => $this->getVendorResellerUnitBuyPrice(),
            self::COLUMN_VENDOR_RESELLER_TOTAL_BUY_PRICE => $this->getVendorResellerTotalBuyPrice(),
            self::COLUMN_VENDOR_END_CUSTOMER_UNIT_BUY_PRICE => $this->getVendorEndCustomerUnitBuyPrice(),
            self::COLUMN_VENDOR_END_CUSTOMER_TOTAL_BUY_PRICE => $this->getVendorEndCustomerTotalBuyPrice(),
            self::COLUMN_COUNTRY_CURRENCY => $this->getCountryCurrency(),
            self::COLUMN_COUNTRY_RETAIL_UNIT_BUY_PRICE => $this->getCountryRetailUnitBuyPrice(),
            self::COLUMN_COUNTRY_RETAIL_TOTAL_BUY_PRICE => $this->getCountryRetailTotalBuyPrice(),
            self::COLUMN_COUNTRY_RESELLER_UNIT_BUY_PRICE => $this->getCountryResellerUnitBuyPrice(),
            self::COLUMN_COUNTRY_RESELLER_TOTAL_BUY_PRICE => $this->getCountryResellerTotalBuyPrice(),
            self::COLUMN_COUNTRY_END_CUSTOMER_UNIT_BUY_PRICE => $this->getCountryEndCustomerUnitBuyPrice(),
            self::COLUMN_COUNTRY_END_CUSTOMER_TOTAL_BUY_PRICE => $this->getCountryEndCustomerTotalBuyPrice(),
        ];
    }
}
