<?php

namespace ArrowSphere\PublicApiClient\Licenses\Entities\License;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

/**
 * Class License
 */
class License extends AbstractEntity
{
    public const COLUMN_ACCEPT_EULA = 'accept_eula';

    public const COLUMN_ACTIVE_SEATS = 'active_seats';

    public const COLUMN_AUTO_RENEW = 'auto_renew';

    public const COLUMN_BASE_SEAT = 'base_seat';

    public const COLUMN_CATEGORY = 'category';

    public const COLUMN_CLOUD_TYPE = 'cloud_type';

    public const COLUMN_CONFIGS = 'configs';

    public const COLUMN_CUSTOMER_NAME = 'customer_name';

    public const COLUMN_CUSTOMER_REF = 'customer_ref';

    public const COLUMN_END_DATE = 'end_date';

    public const COLUMN_FRIENDLY_NAME = 'friendly_name';

    public const COLUMN_ID = 'id';

    public const COLUMN_IS_ENABLED = 'isEnabled';

    public const COLUMN_LAST_UPDATE = 'lastUpdate';

    public const COLUMN_PARENT_LINE_ID = 'parent_line_id';

    public const COLUMN_MARKETPLACE = 'marketplace';

    public const COLUMN_MESSAGE = 'message';

    public const COLUMN_OFFER = 'offer';

    public const COLUMN_PARENT_ORDER_REF = 'parent_order_ref';

    public const COLUMN_PARTNER_REF = 'partner_ref';

    public const COLUMN_PERIODICITY = 'periodicity';

    public const COLUMN_PRICE = 'price';

    public const COLUMN_RESELLER_NAME = 'reseller_name';

    public const COLUMN_RESELLER_REF = 'reseller_ref';

    public const COLUMN_SEAT = 'seat';

    public const COLUMN_SERVICE_REF = 'service_ref';

    public const COLUMN_SKU = 'sku';

    public const COLUMN_START_DATE = 'start_date';

    public const COLUMN_STATUS_CODE = 'status_code';

    public const COLUMN_STATUS_LABEL = 'status_label';

    public const COLUMN_SUBSCRIPTION_ID = 'subscription_id';

    public const COLUMN_SUBSIDIARY_NAME = 'subsidiary_name';

    public const COLUMN_TERM = 'term';

    public const COLUMN_TRIAL = 'trial';

    public const COLUMN_TYPE = 'type';

    public const COLUMN_UOM = 'uom';

    public const COLUMN_VENDOR_BILLING_ID = 'vendor_billing_id';

    public const COLUMN_VENDOR_CODE = 'vendor_code';

    public const COLUMN_VENDOR_NAME = 'vendor_name';

    public const COLUMN_VENDOR_SUBSCRIPTION_ID = 'vendor_subscription_id';

    public const COLUMN_WARNINGS = 'warnings';

    public const COLUMN_SECURITY = 'security';

    public const COLUMN_CUSTOMER_VENDOR_REFERENCE = 'customer_vendor_reference';

    protected const VALIDATION_RULES = [
        self::COLUMN_ACCEPT_EULA     => 'present|boolean',
        self::COLUMN_AUTO_RENEW      => 'present|boolean',
        self::COLUMN_BASE_SEAT       => 'present|numeric',
        self::COLUMN_CLOUD_TYPE      => 'required',
        self::COLUMN_ID              => 'required|numeric',
        self::COLUMN_OFFER           => 'required',
        self::COLUMN_PARTNER_REF     => 'required',
        self::COLUMN_PRICE           => 'required|array',
        self::COLUMN_SEAT            => 'present|numeric',
        self::COLUMN_SKU             => 'required',
        self::COLUMN_STATUS_CODE     => 'required|numeric',
        self::COLUMN_STATUS_LABEL    => 'required',
        self::COLUMN_SUBSCRIPTION_ID => 'required',
        self::COLUMN_SUBSIDIARY_NAME => 'required',
        self::COLUMN_TRIAL           => 'present|boolean',
        self::COLUMN_VENDOR_NAME     => 'required',
        self::COLUMN_VENDOR_CODE     => 'required',
    ];

    /**
     * @var bool
     */
    private $acceptEula;

    /**
     * @var ActiveSeats
     */
    private $activeSeats;

    /**
     * @var bool
     */
    private $autoRenew;

    /**
     * @var int
     */
    private $baseSeat;

    /**
     * @var string
     */
    private $category;

    /**
     * @var string|null
     */
    private $classification;

    /**
     * @var Config[]|null
     */
    private $configs;

    /**
     * @var string
     */
    private $customerName;

    /**
     * @var string
     */
    private $customerRef;

    /**
     * @var string|null
     */
    private $endDate;

    /**
     * @var string|null
     */
    private $friendlyName;

    /**
     * @var int
     */
    private $id;

    /**
     * @var bool
     */
    private $isEnabled;

    /**
     * @var string
     */
    private $lastUpdate;

    /**
     * @var string
     */
    private $marketplace;

    /**
     * @var string
     */
    private $message;

    /**
     * @var string|null
     */
    private $offer;

    /**
     * @var int|null
     */
    private $parentLineId;

    /**
     * @var string|null
     */
    private $parentOrderRef;

    /**
     * @var string
     */
    private $partnerRef;

    /**
     * @var int
     */
    private $periodicity;

    /**
     * @var Price
     */
    private $price;

    /**
     * @var string
     */
    private $resellerName;

    /**
     * @var string
     */
    private $resellerRef;

    /**
     * @var int
     */
    private $seat;

    /**
     * @var string|null
     */
    private $serviceRef;

    /**
     * @var string
     */
    private $sku;

    /**
     * @var string|null
     */
    private $startDate;

    /**
     * @var int
     */
    private $statusCode;

    /**
     * @var string
     */
    private $statusLabel;

    /**
     * @var string
     */
    private $subscriptionId;

    /**
     * @var string|null
     */
    private $subsidiaryName;

    /**
     * @var int
     */
    private $term;

    /**
     * @var bool
     */
    private $trial;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string|null
     */
    private $uom;

    /**
     * @var string|null
     */
    private $vendorBillingId;

    /**
     * @var string
     */
    private $vendorCode;

    /**
     * @var string
     */
    private $vendorName;

    /**
     * @var string
     */
    private $customerVendorReference;

    /**
     * @var string|null
     */
    private $vendorSubscriptionId;

    /**
     * @var Warning[]|null
     */
    private $warnings;

    /**
     * @var Security
     */
    private $security;

    /**
     * License constructor.
     *
     * @param array $data
     *
     * @throws EntityValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->acceptEula = $data[self::COLUMN_ACCEPT_EULA];
        $this->activeSeats = new ActiveSeats($data[self::COLUMN_ACTIVE_SEATS]);
        $this->autoRenew = $data[self::COLUMN_AUTO_RENEW];
        $this->baseSeat = $data[self::COLUMN_BASE_SEAT];
        $this->category = $data[self::COLUMN_CATEGORY];
        $this->classification = $data[self::COLUMN_CLOUD_TYPE];

        if (isset($data[self::COLUMN_CONFIGS])) {
            $this->configs = array_map(static function (array $config) {
                return new Config($config);
            }, $data[self::COLUMN_CONFIGS]);
        }

        if (isset($data[self::COLUMN_WARNINGS])) {
            $this->warnings = array_map(static function (array $warning) {
                return new Warning($warning);
            }, $data[self::COLUMN_WARNINGS]);
        }

        $this->customerName = $data[self::COLUMN_CUSTOMER_NAME];
        $this->customerRef = $data[self::COLUMN_CUSTOMER_REF];
        $this->customerVendorReference = $data[self::COLUMN_CUSTOMER_VENDOR_REFERENCE] ?? '';
        $this->endDate = $data[self::COLUMN_END_DATE];
        $this->friendlyName = $data[self::COLUMN_FRIENDLY_NAME];
        $this->id = $data[self::COLUMN_ID];
        $this->isEnabled = $data[self::COLUMN_IS_ENABLED];
        $this->lastUpdate = $data[self::COLUMN_LAST_UPDATE];
        $this->marketplace = $data[self::COLUMN_MARKETPLACE];
        $this->message = $data[self::COLUMN_MESSAGE];
        $this->offer = $data[self::COLUMN_OFFER];
        $this->parentLineId = $data[self::COLUMN_PARENT_LINE_ID];
        $this->parentOrderRef = $data[self::COLUMN_PARENT_ORDER_REF];
        $this->partnerRef = $data[self::COLUMN_PARTNER_REF];
        $this->periodicity = $data[self::COLUMN_PERIODICITY];
        $this->price = new Price($data[self::COLUMN_PRICE]);
        $this->resellerName = $data[self::COLUMN_RESELLER_NAME];
        $this->resellerRef = $data[self::COLUMN_RESELLER_REF];
        $this->seat = $data[self::COLUMN_SEAT];
        $this->serviceRef = $data[self::COLUMN_SERVICE_REF];
        $this->sku = $data[self::COLUMN_SKU];
        $this->startDate = $data[self::COLUMN_START_DATE];
        $this->statusCode = $data[self::COLUMN_STATUS_CODE];
        $this->statusLabel = $data[self::COLUMN_STATUS_LABEL];
        $this->subscriptionId = $data[self::COLUMN_SUBSCRIPTION_ID];
        $this->subsidiaryName = $data[self::COLUMN_SUBSIDIARY_NAME];
        $this->term = $data[self::COLUMN_TERM];
        $this->trial = $data[self::COLUMN_TRIAL];
        $this->type = $data[self::COLUMN_TYPE];
        $this->uom = $data[self::COLUMN_UOM];
        $this->vendorBillingId = $data[self::COLUMN_VENDOR_BILLING_ID] ?? null;
        $this->vendorCode = $data[self::COLUMN_VENDOR_CODE];
        $this->vendorName = $data[self::COLUMN_VENDOR_NAME];
        $this->vendorSubscriptionId = $data[self::COLUMN_VENDOR_SUBSCRIPTION_ID];
        $this->security = new Security($data[self::COLUMN_SECURITY] ?? []);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return bool
     */
    public function getAcceptEula(): bool
    {
        return $this->acceptEula;
    }

    /**
     * @return ActiveSeats
     */
    public function getActiveSeats(): ActiveSeats
    {
        return $this->activeSeats;
    }

    /**
     * @return bool
     */
    public function isAutoRenew(): bool
    {
        return $this->autoRenew;
    }

    /**
     * @return int
     */
    public function getBaseSeat(): int
    {
        return $this->baseSeat;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @return string|null
     */
    public function getClassification(): ?string
    {
        return $this->classification;
    }

    /**
     * @return Config[]|null
     */
    public function getConfigs(): ?array
    {
        return $this->configs;
    }

    /**
     * @return string
     */
    public function getCustomerName(): string
    {
        return $this->customerName;
    }

    /**
     * @return string
     */
    public function getCustomerRef(): string
    {
        return $this->customerRef;
    }

    /**
     * @return string
     */
    public function getCustomerVendorReference(): string
    {
        return $this->customerVendorReference;
    }

    /**
     * @return string|null
     */
    public function getEndDate(): ?string
    {
        return $this->endDate;
    }

    /**
     * @return string|null
     */
    public function getFriendlyName(): ?string
    {
        return $this->friendlyName;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->isEnabled;
    }

    /**
     * @return string
     */
    public function getLastUpdate(): string
    {
        return $this->lastUpdate;
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
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return string|null
     */
    public function getOffer(): ?string
    {
        return $this->offer;
    }

    /**
     * @return int|null
     */
    public function getParentLineId(): ?int
    {
        return $this->parentLineId;
    }

    /**
     * @return string|null
     */
    public function getParentOrderRef(): ?string
    {
        return $this->parentOrderRef;
    }

    /**
     * @return string
     */
    public function getPartnerRef(): string
    {
        return $this->partnerRef;
    }

    /**
     * @return int
     */
    public function getPeriodicity(): int
    {
        return $this->periodicity;
    }

    /**
     * @return Price
     */
    public function getPrice(): Price
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getResellerName(): string
    {
        return $this->resellerName;
    }

    /**
     * @return string
     */
    public function getResellerRef(): string
    {
        return $this->resellerRef;
    }

    /**
     * @return int
     */
    public function getSeat(): int
    {
        return $this->seat;
    }

    /**
     * @return string|null
     */
    public function getServiceRef(): ?string
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
     * @return string|null
     */
    public function getStartDate(): ?string
    {
        return $this->startDate;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @return string
     */
    public function getStatusLabel(): string
    {
        return $this->statusLabel;
    }

    /**
     * @return string
     */
    public function getSubscriptionId(): string
    {
        return $this->subscriptionId;
    }

    /**
     * @return string|null
     */
    public function getSubsidiaryName(): ?string
    {
        return $this->subsidiaryName;
    }

    /**
     * @return int
     */
    public function getTerm(): int
    {
        return $this->term;
    }

    /**
     * @return bool
     */
    public function isTrial(): bool
    {
        return $this->trial;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string|null
     */
    public function getUom(): ?string
    {
        return $this->uom;
    }

    /**
     * @return string|null
     */
    public function getVendorBillingId(): ?string
    {
        return $this->vendorBillingId;
    }

    /**
     * @return string
     */
    public function getVendorCode(): string
    {
        return $this->vendorCode;
    }

    /**
     * @return string
     */
    public function getVendorName(): string
    {
        return $this->vendorName;
    }

    /**
     * @return string|null
     */
    public function getVendorSubscriptionId(): ?string
    {
        return $this->vendorSubscriptionId;
    }

    /**
     * @return Warning[]|null
     */
    public function getWarnings(): ?array
    {
        return $this->warnings;
    }

    /**
     * @return Security
     */
    public function getSecurity(): Security
    {
        return $this->security;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_ID => $this->id,
            self::COLUMN_SUBSCRIPTION_ID => $this->subscriptionId,
            self::COLUMN_PARENT_LINE_ID => $this->parentLineId,
            self::COLUMN_PARENT_ORDER_REF => $this->parentOrderRef,
            self::COLUMN_VENDOR_NAME => $this->vendorName,
            self::COLUMN_VENDOR_CODE => $this->vendorCode,
            self::COLUMN_SUBSIDIARY_NAME => $this->subsidiaryName,
            self::COLUMN_PARTNER_REF => $this->partnerRef,
            self::COLUMN_STATUS_CODE => $this->statusCode,
            self::COLUMN_STATUS_LABEL => $this->statusLabel,
            self::COLUMN_SERVICE_REF => $this->serviceRef,
            self::COLUMN_SKU => $this->sku,
            self::COLUMN_UOM => $this->uom,
            self::COLUMN_PRICE => $this->price->jsonSerialize(),
            self::COLUMN_CLOUD_TYPE => $this->classification,
            self::COLUMN_BASE_SEAT => $this->baseSeat,
            self::COLUMN_CONFIGS => $this->jsonSerializeConfigs(),
            self::COLUMN_SEAT => $this->seat,
            self::COLUMN_TRIAL => $this->trial,
            self::COLUMN_AUTO_RENEW => $this->autoRenew,
            self::COLUMN_OFFER => $this->offer,
            self::COLUMN_CATEGORY => $this->category,
            self::COLUMN_TYPE => $this->type,
            self::COLUMN_START_DATE => $this->startDate,
            self::COLUMN_END_DATE => $this->endDate,
            self::COLUMN_ACCEPT_EULA => $this->acceptEula,
            self::COLUMN_CUSTOMER_REF => $this->customerRef,
            self::COLUMN_CUSTOMER_NAME => $this->customerName,
            self::COLUMN_CUSTOMER_VENDOR_REFERENCE => $this->customerVendorReference,
            self::COLUMN_RESELLER_REF => $this->resellerRef,
            self::COLUMN_RESELLER_NAME => $this->resellerName,
            self::COLUMN_MARKETPLACE => $this->marketplace,
            self::COLUMN_ACTIVE_SEATS => $this->activeSeats->jsonSerialize(),
            self::COLUMN_FRIENDLY_NAME => $this->friendlyName,
            self::COLUMN_VENDOR_BILLING_ID => $this->vendorBillingId,
            self::COLUMN_VENDOR_SUBSCRIPTION_ID => $this->vendorSubscriptionId,
            self::COLUMN_MESSAGE => $this->message,
            self::COLUMN_PERIODICITY => $this->periodicity,
            self::COLUMN_TERM => $this->term,
            self::COLUMN_IS_ENABLED => $this->isEnabled,
            self::COLUMN_LAST_UPDATE => $this->lastUpdate,
            self::COLUMN_WARNINGS => $this->jsonSerializeWarnings(),
            self::COLUMN_SECURITY => $this->security,
        ];
    }

    private function jsonSerializeConfigs(): ?array
    {
        $configs = null;

        if (is_array($this->configs)) {
            $configs = array_map(static function (Config $config) {
                return $config->jsonSerialize();
            }, $this->configs);
        }

        return $configs;
    }

    private function jsonSerializeWarnings(): ?array
    {
        $warnings = null;

        if (is_array($this->warnings)) {
            $warnings = array_map(static function (Warning $warning) {
                return $warning->jsonSerialize();
            }, $this->warnings);
        }

        return $warnings;
    }
}
