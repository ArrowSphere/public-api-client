<?php

namespace ArrowSphere\PublicApiClient\Consumption\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;
use ArrowSphere\PublicApiClient\General\Enum\ClassificationEnum;

class MonthlyAnalyticsItem extends AbstractEntity
{
    public const COLUMN_VENDOR = 'vendor';
    public const COLUMN_MARKETPLACE = 'marketplace';
    public const COLUMN_CLASSIFICATION = 'classification';
    public const COLUMN_TAG = 'tag';
    public const COLUMN_LOCALPRICE = 'localPrice';
    public const COLUMN_USDPRICE = 'usdPrice';
    public const COLUMN_RESELLERPRICE = 'resellerBuyPrice';
    public const COLUMN_ARROWPRICE = 'arrowBuyPrice';
    public const COLUMN_CURRENCY = 'currency';
    public const COLUMN_MONTH = 'month';

    protected const VALIDATION_RULES = [
        self::COLUMN_VENDOR                                         => 'string|required',
        self::COLUMN_MARKETPLACE                                    => 'string|required',
        self::COLUMN_CLASSIFICATION                                 => 'string|required',
        self::COLUMN_TAG                                            => 'string|nullable|present',
        self::COLUMN_USDPRICE . '.' . self::COLUMN_RESELLERPRICE    => 'numeric|required',
        self::COLUMN_USDPRICE . '.' . self::COLUMN_ARROWPRICE       => 'numeric',
        self::COLUMN_USDPRICE . '.' . self::COLUMN_CURRENCY         => 'string|required',
        self::COLUMN_LOCALPRICE . '.' . self::COLUMN_RESELLERPRICE  => 'numeric|required',
        self::COLUMN_LOCALPRICE . '.' . self::COLUMN_ARROWPRICE     => 'numeric',
        self::COLUMN_LOCALPRICE . '.' . self::COLUMN_CURRENCY       => 'string|required',
    ];

    /** @var string */
    private $vendor;

    /** @var string */
    private $marketPlace;

    /** @var string */
    private $classification;

    /** @var string|null */
    private $tag;

    /** @var PriceAnalyticsItem */
    private $localPrice;

    /** @var PriceAnalyticsItem */
    private $usdPrice;

    /** @var string */
    private $month;

    /**
     * MonthlyAnalyticsItem constructor.
     * @param array $data
     * @throws EntityValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        if (! ClassificationEnum::isValidName($data[self::COLUMN_CLASSIFICATION])) {
            throw new EntityValidationException('Classification: ' . $data[self::COLUMN_CLASSIFICATION] . ' not supported');
        }

        $this->tag = $data[self::COLUMN_TAG];
        $this->classification = $data[self::COLUMN_CLASSIFICATION];
        $this->marketPlace = $data[self::COLUMN_MARKETPLACE];
        $this->vendor = $data[self::COLUMN_VENDOR];
        $this->month = $data[self::COLUMN_MONTH];
        $this->localPrice = new PriceAnalyticsItem($data[self::COLUMN_LOCALPRICE]);
        $this->usdPrice = new PriceAnalyticsItem($data[self::COLUMN_USDPRICE]);
    }

    /**
     * @return string
     */
    public function getVendor() : string
    {
        return $this->vendor;
    }

    /**
     * @return string
     */
    public function getMarketPlace() : string
    {
        return $this->marketPlace;
    }

    /**
     * @return string
     */
    public function getClassification() : string
    {
        return $this->classification;
    }

    /**
     * @return string|null
     */
    public function getTag() : ?string
    {
        return $this->tag;
    }

    /**
     * @return PriceAnalyticsItem
     */
    public function getUsdPrice() : PriceAnalyticsItem
    {
        return $this->usdPrice;
    }

    /**
     * @return PriceAnalyticsItem
     */
    public function getLocalPrice() : PriceAnalyticsItem
    {
        return $this->localPrice;
    }

    /**
     * @return string
     */
    public function getMonth() : string
    {
        return $this->month;
    }

    public function jsonSerialize()
    {
        return [
            self::COLUMN_VENDOR         => $this->getVendor(),
            self::COLUMN_MARKETPLACE    => $this->getMarketPlace(),
            self::COLUMN_CLASSIFICATION => $this->getClassification(),
            self::COLUMN_TAG            => $this->getTag(),
            self::COLUMN_MONTH          => $this->getMonth(),
            self::COLUMN_LOCALPRICE     => $this->getLocalPrice()->jsonSerialize(),
            self::COLUMN_USDPRICE       => $this->getUsdPrice()->jsonSerialize()
        ];
    }
}