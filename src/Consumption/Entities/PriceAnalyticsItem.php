<?php

namespace ArrowSphere\PublicApiClient\Consumption\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

class PriceAnalyticsItem extends AbstractEntity
{
    public const COLUMN_RESELLERPRICE = 'resellerBuyPrice';
    public const COLUMN_ARROWPRICE = 'arrowBuyPrice';
    public const COLUMN_CURRENCY = 'currency';
    public const COLUMN_ENDCUSTOMERPRICE = 'endCustomerBuyPrice';
    public const COLUMN_LISTPRICE = 'listBuyPrice';

    protected const VALIDATION_RULES = [
        self::COLUMN_RESELLERPRICE    => 'numeric|required',
        self::COLUMN_ARROWPRICE       => 'numeric',
        self::COLUMN_ENDCUSTOMERPRICE => 'numeric|nullable',
        self::COLUMN_LISTPRICE        => 'numeric|required',
        self::COLUMN_CURRENCY         => 'string|required',
    ];

    /** @var float */
    private $resellerBuyPrice;

    /** @var float */
    private $arrowBuyPrice;

    /** @var float */
    private $listBuyPrice;

    /** @var float */
    private $endCustomerBuyPrice;

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
        $this->listBuyPrice = $data[self::COLUMN_LISTPRICE];
        $this->currency = $data[self::COLUMN_CURRENCY];

        if (isset($data[self::COLUMN_ARROWPRICE])) {
            $this->arrowBuyPrice = $data[self::COLUMN_ARROWPRICE];
        }
        if (isset($data[self::COLUMN_ENDCUSTOMERPRICE])) {
            $this->endCustomerBuyPrice = $data[self::COLUMN_ENDCUSTOMERPRICE];
        }
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
    public function add(PriceAnalyticsItem $item) : void {
        $this->resellerBuyPrice += $item->getResellerBuyPrice();
        $this->arrowBuyPrice += $item->getArrowBuyPrice() ?? 0;
        $this->listBuyPrice += $item->getListBuyPrice();
        $this->endCustomerBuyPrice += $item->getEndCustomerBuyPrice() ?? 0;

        $this->currency = $item->getCurrency();
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            self::COLUMN_RESELLERPRICE    => $this->getResellerBuyPrice(),
            self::COLUMN_ARROWPRICE       => $this->getArrowBuyPrice(),
            self::COLUMN_LISTPRICE        => $this->getListBuyPrice(),
            self::COLUMN_ENDCUSTOMERPRICE => $this->getEndCustomerBuyPrice(),
            self::COLUMN_CURRENCY         => $this->getCurrency()
        ];
    }
}