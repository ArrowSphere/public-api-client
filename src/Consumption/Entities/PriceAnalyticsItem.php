<?php

namespace ArrowSphere\PublicApiClient\Consumption\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

class PriceAnalyticsItem extends AbstractEntity
{
    public const COLUMN_RESELLERPRICE = 'resellerBuyPrice';
    public const COLUMN_ARROWPRICE = 'arrowBuyPrice';
    public const COLUMN_CURRENCY = 'currency';

    protected const VALIDATION_RULES = [
        self::COLUMN_RESELLERPRICE  => 'numeric|required',
        self::COLUMN_ARROWPRICE     => 'numeric',
        self::COLUMN_CURRENCY       => 'string|required',
    ];

    /** @var int */
    private $resellerBuyPrice;

    /** @var int */
    private $arrowBuyPrice;

    /** @var string */
    private $currency;

    /**
     * PriceAnalyticsItem constructor.
     * @param array $data
     * @throws EntityValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->resellerBuyPrice = $data[self::COLUMN_RESELLERPRICE];
        if (isset($data[self::COLUMN_ARROWPRICE])) {
            $this->arrowBuyPrice = $data[self::COLUMN_ARROWPRICE];
        }
        $this->currency = $data[self::COLUMN_CURRENCY];
    }

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
     * @param PriceAnalyticsItem $item
     */
    public function add(PriceAnalyticsItem $item) : void {
        $this->resellerBuyPrice += $item->getResellerBuyPrice();
        $this->arrowBuyPrice += $item->getArrowBuyPrice();
        $this->currency = $item->getCurrency();
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            self::COLUMN_RESELLERPRICE => $this->getResellerBuyPrice(),
            self::COLUMN_ARROWPRICE    => $this->getArrowBuyPrice(),
            self::COLUMN_CURRENCY      => $this->getCurrency()
        ];
    }
}