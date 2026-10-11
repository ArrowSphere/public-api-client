<?php

namespace ArrowSphere\PublicApiClient\Consumption\Entities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Exception\EntitiesException;
use ArrowSphere\PublicApiClient\Entities\Property;
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
    public const COLUMN_ENDCUSTOMERPRICE = 'endCustomerBuyPrice';
    public const COLUMN_LISTPRICE = 'listBuyPrice';
    public const COLUMN_CURRENCY = 'currency';
    public const COLUMN_MONTH = 'month';

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_VENDOR, required: true)]
    protected string $vendor;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_MARKETPLACE, required: true)]
    protected string $marketPlace;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_CLASSIFICATION, required: true)]
    protected string $classification;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_TAG, serializeNull: true)]
    protected ?string $tag = null;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_MONTH, required: true)]
    protected string $month;

    /**
     * @var PriceAnalyticsItem
     */
    #[Property(name: self::COLUMN_LOCALPRICE, type: PriceAnalyticsItem::class, required: true)]
    protected PriceAnalyticsItem $localPrice;

    /**
     * @var PriceAnalyticsItem
     */
    #[Property(name: self::COLUMN_USDPRICE, type: PriceAnalyticsItem::class, required: true)]
    protected PriceAnalyticsItem $usdPrice;

    /**
     * MonthlyAnalyticsItem constructor.
     *
     * @param array $data
     *
     * @throws EntitiesException
     * @throws EntityValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        if (! ClassificationEnum::isValidName($this->classification)) {
            throw new EntityValidationException('Classification: ' . $this->classification . ' not supported');
        }
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
}
