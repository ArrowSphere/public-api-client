<?php

namespace ArrowSphere\PublicApiClient\Consumption\Entities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

class PriceAnalyticsItem extends AbstractEntity
{
    public const COLUMN_RESELLERPRICE = 'resellerBuyPrice';
    public const COLUMN_ARROWPRICE = 'arrowBuyPrice';
    public const COLUMN_CURRENCY = 'currency';
    public const COLUMN_ENDCUSTOMERPRICE = 'endCustomerBuyPrice';
    public const COLUMN_LISTPRICE = 'listBuyPrice';

    /**
     * @var float
     */
    #[Property(name: self::COLUMN_RESELLERPRICE, type: 'float', required: true)]
    protected float $resellerBuyPrice;

    /**
     * @var float|null
     */
    #[Property(name: self::COLUMN_ARROWPRICE, type: 'float', serializeNull: true)]
    protected ?float $arrowBuyPrice = null;

    /**
     * @var float
     */
    #[Property(name: self::COLUMN_LISTPRICE, type: 'float', required: true)]
    protected float $listBuyPrice;

    /**
     * @var float|null
     */
    #[Property(name: self::COLUMN_ENDCUSTOMERPRICE, type: 'float', serializeNull: true)]
    protected ?float $endCustomerBuyPrice = null;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_CURRENCY, required: true)]
    protected string $currency;

    /**
     * @return string
     */
    public function getCurrency() : string
    {
        return $this->currency;
    }

    /**
     * @return float
     */
    public function getResellerBuyPrice() : float
    {
        return $this->resellerBuyPrice;
    }

    /**
     * @return float|null
     */
    public function getArrowBuyPrice() : ?float
    {
        return $this->arrowBuyPrice;
    }

    /**
     * @return float
     */
    public function getListBuyPrice() : float
    {
        return $this->listBuyPrice;
    }

    /**
     * @return float|null
     */
    public function getEndCustomerBuyPrice() : ?float
    {
        return $this->endCustomerBuyPrice;
    }

    /**
     * @param PriceAnalyticsItem $item
     */
    public function add(PriceAnalyticsItem $item) : void
    {
        $this->resellerBuyPrice += $item->getResellerBuyPrice();
        $this->arrowBuyPrice += $item->getArrowBuyPrice() ?? 0;
        $this->listBuyPrice += $item->getListBuyPrice();
        $this->endCustomerBuyPrice += $item->getEndCustomerBuyPrice() ?? 0;

        $this->currency = $item->getCurrency();
    }
}
