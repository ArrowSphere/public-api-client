<?php

namespace ArrowSphere\PublicApiClient\Licenses\Entities\License;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Exception\EntitiesException;
use ArrowSphere\PublicApiClient\Entities\Property;

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

    public const COLUMN_NEXT_RENEWAL_DATE = 'next_renewal_date';

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

    public const COLUMN_ATTRIBUTES = 'attributes';

    public const COLUMN_CUSTOMER_VENDOR_REFERENCE = 'customerVendorReference';

    /**
     * @var bool
     */
    #[Property(name: self::COLUMN_ACCEPT_EULA, type: 'bool', required: true)]
    protected bool $acceptEula;

    /**
     * @var ActiveSeats
     */
    #[Property(name: self::COLUMN_ACTIVE_SEATS, type: ActiveSeats::class, required: true)]
    protected ActiveSeats $activeSeats;

    /**
     * @var bool
     */
    #[Property(name: self::COLUMN_AUTO_RENEW, type: 'bool', required: true)]
    protected bool $autoRenew;

    /**
     * @var int
     */
    #[Property(name: self::COLUMN_BASE_SEAT, type: 'int', required: true)]
    protected int $baseSeat;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_CATEGORY, required: true)]
    protected string $category;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_CLOUD_TYPE, serializeNull: true)]
    protected ?string $classification = null;

    /**
     * @var Config[]|null
     */
    #[Property(name: self::COLUMN_CONFIGS, type: Config::class, isArray: true, serializeNull: true)]
    protected ?array $configs = null;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_CUSTOMER_NAME, required: true)]
    protected string $customerName;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_CUSTOMER_REF, required: true)]
    protected string $customerRef;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_END_DATE, serializeNull: true)]
    protected ?string $endDate = null;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_FRIENDLY_NAME, serializeNull: true)]
    protected ?string $friendlyName = null;

    /**
     * @var int
     */
    #[Property(name: self::COLUMN_ID, type: 'int', required: true)]
    protected int $id;

    /**
     * @var bool
     */
    #[Property(name: self::COLUMN_IS_ENABLED, type: 'bool', required: true)]
    protected bool $isEnabled;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_LAST_UPDATE, serializeNull: true)]
    protected ?string $lastUpdate = null;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_MARKETPLACE, required: true)]
    protected string $marketplace;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_MESSAGE, required: true)]
    protected string $message;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_NEXT_RENEWAL_DATE, serializeNull: true)]
    protected ?string $nextRenewalDate = null;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_OFFER, serializeNull: true)]
    protected ?string $offer = null;

    /**
     * @var int|null
     */
    #[Property(name: self::COLUMN_PARENT_LINE_ID, type: 'int', serializeNull: true)]
    protected ?int $parentLineId = null;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_PARENT_ORDER_REF, serializeNull: true)]
    protected ?string $parentOrderRef = null;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_PARTNER_REF, required: true)]
    protected string $partnerRef;

    /**
     * @var int
     */
    #[Property(name: self::COLUMN_PERIODICITY, type: 'int', required: true)]
    protected int $periodicity;

    /**
     * @var Price
     */
    #[Property(name: self::COLUMN_PRICE, type: Price::class, required: true)]
    protected Price $price;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_RESELLER_NAME, required: true)]
    protected string $resellerName;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_RESELLER_REF, required: true)]
    protected string $resellerRef;

    /**
     * @var int
     */
    #[Property(name: self::COLUMN_SEAT, type: 'int', required: true)]
    protected int $seat;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_SERVICE_REF, serializeNull: true)]
    protected ?string $serviceRef = null;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_SKU, required: true)]
    protected string $sku;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_START_DATE, serializeNull: true)]
    protected ?string $startDate = null;

    /**
     * @var int
     */
    #[Property(name: self::COLUMN_STATUS_CODE, type: 'int', required: true)]
    protected int $statusCode;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_STATUS_LABEL, required: true)]
    protected string $statusLabel;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_SUBSCRIPTION_ID, required: true)]
    protected string $subscriptionId;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_SUBSIDIARY_NAME, serializeNull: true)]
    protected ?string $subsidiaryName = null;

    /**
     * @var int
     */
    #[Property(name: self::COLUMN_TERM, type: 'int', required: true)]
    protected int $term;

    /**
     * @var bool
     */
    #[Property(name: self::COLUMN_TRIAL, type: 'bool', required: true)]
    protected bool $trial;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_TYPE, required: true)]
    protected string $type;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_UOM, serializeNull: true)]
    protected ?string $uom = null;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_VENDOR_BILLING_ID, serializeNull: true)]
    protected ?string $vendorBillingId = null;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_VENDOR_CODE, required: true)]
    protected string $vendorCode;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_VENDOR_NAME, required: true)]
    protected string $vendorName;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_CUSTOMER_VENDOR_REFERENCE)]
    protected string $customerVendorReference = '';

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_VENDOR_SUBSCRIPTION_ID, serializeNull: true)]
    protected ?string $vendorSubscriptionId = null;

    /**
     * @var Warning[]|null
     */
    #[Property(name: self::COLUMN_WARNINGS, type: Warning::class, isArray: true, serializeNull: true)]
    protected ?array $warnings = null;

    /**
     * @var Security
     */
    #[Property(name: self::COLUMN_SECURITY, type: Security::class, required: true)]
    protected Security $security;

    /**
     * @var array<string,string>
     */
    #[Property(name: self::COLUMN_ATTRIBUTES, type: 'array')]
    protected array $attributes = [];

    /**
     * License constructor.
     *
     * @param array $data
     *
     * @throws EntitiesException
     */
    public function __construct(array $data)
    {
        // A missing or empty security gets an instance with its default values, as an empty array would be considered as missing
        if (empty($data[self::COLUMN_SECURITY])) {
            $data[self::COLUMN_SECURITY] = new Security([]);
        }

        parent::__construct($data);

        // The price totals depend on the number of seats, which the attribute hydration does not know
        $this->price = new Price((array) $data[self::COLUMN_PRICE], $this->seat);

        // The renewal date defaults to the end date
        $this->nextRenewalDate ??= $this->endDate;

        // An empty list stays an empty list, the attribute hydration would consider it as missing
        if (($data[self::COLUMN_CONFIGS] ?? null) === []) {
            $this->configs = [];
        }

        if (($data[self::COLUMN_WARNINGS] ?? null) === []) {
            $this->warnings = [];
        }
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
     * @return string|null
     */
    public function getLastUpdate(): ?string
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
    public function getNextRenewalDate(): ?string
    {
        return $this->nextRenewalDate;
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
     * @return array<string,string>
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }
}
