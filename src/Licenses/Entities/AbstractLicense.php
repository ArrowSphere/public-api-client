<?php

namespace ArrowSphere\PublicApiClient\Licenses\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

/**
 * Class AbstractLicense
 */
abstract class AbstractLicense extends AbstractEntity
{
    public const COLUMN_ACCEPT_EULA = 'accept_eula';

    public const COLUMN_AUTO_RENEW = 'auto_renew';

    public const COLUMN_BASE_SEAT = 'base_seat';

    public const COLUMN_CATEGORY = 'category';

    public const COLUMN_CLOUD_TYPE = 'cloud_type';

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

    public const COLUMN_VENDOR_CODE = 'vendor_code';

    public const COLUMN_VENDOR_NAME = 'vendor_name';

    public const COLUMN_VENDOR_SUBSCRIPTION_ID = 'vendor_subscription_id';

    protected const VALIDATION_RULES = [
        self::COLUMN_ID              => 'required|numeric',
        self::COLUMN_SUBSCRIPTION_ID => 'required',
        self::COLUMN_VENDOR_NAME     => 'required',
        self::COLUMN_VENDOR_CODE     => 'required',
        self::COLUMN_SUBSIDIARY_NAME => 'required',
        self::COLUMN_PARTNER_REF     => 'required',
        self::COLUMN_STATUS_CODE     => 'required|numeric',
        self::COLUMN_STATUS_LABEL    => 'required',
        self::COLUMN_SKU             => 'required',
        'price'                      => 'required|array',
        'price.buy_price'            => 'present|numeric',
        'price.list_price'           => 'present|numeric',
        'price.currency'             => 'required',
        self::COLUMN_CLOUD_TYPE      => 'required',
        self::COLUMN_BASE_SEAT       => 'present|numeric',
        self::COLUMN_SEAT            => 'present|numeric',
        self::COLUMN_TRIAL           => 'present|boolean',
        self::COLUMN_AUTO_RENEW      => 'present|boolean',
        self::COLUMN_OFFER           => 'required',
        self::COLUMN_ACCEPT_EULA     => 'present|boolean',

    ];

    /** @var bool */
    private $acceptEula;

    /** @var string|null */
    private $activeSeatsLastUpdate;

    /** @var float|null */
    private $activeSeatsNumber;

    /** @var bool */
    private $autoRenew;

    /** @var int */
    private $baseSeat;

    /** @var float */
    private $buyPrice;

    /** @var string */
    private $category;

    /** @var string */
    private $classification;

    /** @var string */
    private $currency;

    /** @var string */
    private $customerName;

    /** @var string */
    private $customerRef;

    /** @var string */
    private $endDate;

    /** @var string */
    private $friendlyName;

    /** @var int */
    private $id;

    /** @var bool */
    private $isEnabled;

    /** @var string */
    private $lastUpdate;

    /** @var float */
    private $listPrice;

    /** @var string */
    private $marketplace;

    /** @var string */
    private $message;

    /** @var string */
    private $offer;

    /** @var int|null */
    private $parentLineId;

    /** @var string|null */
    private $parentOrderRef;

    /** @var string */
    private $partnerRef;

    /** @var int */
    private $periodicity;

    /** @var string */
    private $resellerName;

    /** @var string */
    private $resellerRef;

    /** @var int */
    private $seat;

    /** @var string */
    private $serviceRef;

    /** @var string */
    private $sku;

    /** @var string */
    private $startDate;

    /** @var int */
    private $statusCode;

    /** @var string */
    private $statusLabel;

    /** @var string */
    private $subscriptionId;

    /** @var string */
    private $subsidiaryName;

    /** @var int */
    private $term;

    /** @var bool */
    private $trial;

    /** @var string */
    private $type;

    /** @var string */
    private $uom;

    /** @var string */
    private $vendorCode;

    /** @var string */
    private $vendorName;

    /** @var string */
    private $vendorSubscriptionId;

    /**
     * AbstractLicense constructor.
     *
     * @param array $data
     * @throws EntityValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->acceptEula = $data[self::COLUMN_ACCEPT_EULA];
        $this->activeSeatsLastUpdate = $data['active_seats']['lastUpdate'];
        $this->activeSeatsNumber = $data['active_seats']['number'];
        $this->autoRenew = $data[self::COLUMN_AUTO_RENEW];
        $this->baseSeat = $data[self::COLUMN_BASE_SEAT];
        $this->buyPrice = $data['price']['buy_price'];
        $this->category = $data[self::COLUMN_CATEGORY];
        $this->classification = $data[self::COLUMN_CLOUD_TYPE];
        $this->currency = $data['price']['currency'];
        $this->customerName = $data[self::COLUMN_CUSTOMER_NAME];
        $this->customerRef = $data[self::COLUMN_CUSTOMER_REF];
        $this->endDate = $data[self::COLUMN_END_DATE];
        $this->friendlyName = $data[self::COLUMN_FRIENDLY_NAME];
        $this->id = $data[self::COLUMN_ID];
        $this->isEnabled = $data[self::COLUMN_IS_ENABLED];
        $this->lastUpdate = $data[self::COLUMN_LAST_UPDATE];
        $this->listPrice = $data['price']['list_price'];
        $this->marketplace = $data[self::COLUMN_MARKETPLACE];
        $this->message = $data[self::COLUMN_MESSAGE];
        $this->offer = $data[self::COLUMN_OFFER];
        $this->parentLineId = $data[self::COLUMN_PARENT_LINE_ID];
        $this->parentOrderRef = $data[self::COLUMN_PARENT_ORDER_REF];
        $this->partnerRef = $data[self::COLUMN_PARTNER_REF];
        $this->periodicity = $data[self::COLUMN_PERIODICITY];
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
        $this->vendorCode = $data[self::COLUMN_VENDOR_CODE];
        $this->vendorName = $data[self::COLUMN_VENDOR_NAME];
        $this->vendorSubscriptionId = $data[self::COLUMN_VENDOR_SUBSCRIPTION_ID];
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
    public function isAcceptEula(): bool
    {
        return $this->acceptEula;
    }

    /**
     * @return string|null
     */
    public function getActiveSeatsLastUpdate(): ?string
    {
        return $this->activeSeatsLastUpdate;
    }

    /**
     * @return float|null
     */
    public function getActiveSeatsNumber(): ?float
    {
        return $this->activeSeatsNumber;
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
     * @return float
     */
    public function getBuyPrice(): float
    {
        return $this->buyPrice;
    }

    /**
     * @return string
     */
    public function getCategory(): string
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
    public function getCurrency(): string
    {
        return $this->currency;
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
    public function getEndDate(): string
    {
        return $this->endDate;
    }

    /**
     * @return string
     */
    public function getFriendlyName(): string
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
     * @return float
     */
    public function getListPrice(): float
    {
        return $this->listPrice;
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
     * @return string
     */
    public function getOffer(): string
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
    public function getStartDate(): string
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
     * @return string
     */
    public function getSubsidiaryName(): string
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
     * @return string
     */
    public function getUom(): string
    {
        return $this->uom;
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
     * @return string
     */
    public function getVendorSubscriptionId(): string
    {
        return $this->vendorSubscriptionId;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            self::COLUMN_ID                     => $this->id,
            self::COLUMN_SUBSCRIPTION_ID        => $this->subscriptionId,
            self::COLUMN_PARENT_LINE_ID         => $this->parentLineId,
            self::COLUMN_PARENT_ORDER_REF       => $this->parentOrderRef,
            self::COLUMN_VENDOR_NAME            => $this->vendorName,
            self::COLUMN_VENDOR_CODE            => $this->vendorCode,
            self::COLUMN_SUBSIDIARY_NAME        => $this->subsidiaryName,
            self::COLUMN_PARTNER_REF            => $this->partnerRef,
            self::COLUMN_STATUS_CODE            => $this->statusCode,
            self::COLUMN_STATUS_LABEL           => $this->statusLabel,
            self::COLUMN_SERVICE_REF            => $this->serviceRef,
            self::COLUMN_SKU                    => $this->sku,
            self::COLUMN_UOM                    => $this->uom,
            'price'                             => [
                'buy_price'  => $this->buyPrice,
                'list_price' => $this->listPrice,
                'currency'   => $this->currency,
            ],
            self::COLUMN_CLOUD_TYPE             => $this->classification,
            self::COLUMN_BASE_SEAT              => $this->baseSeat,
            self::COLUMN_SEAT                   => $this->seat,
            self::COLUMN_TRIAL                  => $this->trial,
            self::COLUMN_AUTO_RENEW             => $this->autoRenew,
            self::COLUMN_OFFER                  => $this->offer,
            self::COLUMN_CATEGORY               => $this->category,
            self::COLUMN_TYPE                   => $this->type,
            self::COLUMN_START_DATE             => $this->startDate,
            self::COLUMN_END_DATE               => $this->endDate,
            self::COLUMN_ACCEPT_EULA            => $this->acceptEula,
            self::COLUMN_CUSTOMER_REF           => $this->customerRef,
            self::COLUMN_CUSTOMER_NAME          => $this->customerName,
            self::COLUMN_RESELLER_REF           => $this->resellerRef,
            self::COLUMN_RESELLER_NAME          => $this->resellerName,
            self::COLUMN_MARKETPLACE            => $this->marketplace,
            'active_seats'                      => [
                'number'     => $this->activeSeatsNumber,
                'lastUpdate' => $this->activeSeatsLastUpdate,
            ],
            self::COLUMN_FRIENDLY_NAME          => $this->friendlyName,
            self::COLUMN_VENDOR_SUBSCRIPTION_ID => $this->vendorSubscriptionId,
            self::COLUMN_MESSAGE                => $this->message,
            self::COLUMN_PERIODICITY            => $this->periodicity,
            self::COLUMN_TERM                   => $this->term,
            self::COLUMN_IS_ENABLED             => $this->isEnabled,
            self::COLUMN_LAST_UPDATE            => $this->lastUpdate,
        ];
    }
}
