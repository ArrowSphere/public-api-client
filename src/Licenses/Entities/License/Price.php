<?php

namespace ArrowSphere\PublicApiClient\Licenses\Entities\License;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

/**
 * Class Price
 */
class Price extends AbstractEntity
{
    public const COLUMN_PRICE_BAND_ARROWSPHERE_SKU = 'priceBandArrowsphereSku';

    public const COLUMN_BUY_PRICE = 'buy_price';

    public const COLUMN_SELL_PRICE = 'sell_price';

    public const COLUMN_LIST_PRICE = 'list_price';

    public const COLUMN_CURRENCY = 'currency';

    /**
     * @var string|null
     */
    private $priceBandArrowsphereSku;

    /**
     * @var float
     */
    private $buyPrice;

    /**
     * @var float
     */
    private $listPrice;

    /**
     * @var float
     */
    private $sellPrice;

    /**
     * @var string|null
     */
    private $currency;

    protected const VALIDATION_RULES = [
        self::COLUMN_PRICE_BAND_ARROWSPHERE_SKU => 'present',
        self::COLUMN_BUY_PRICE                  => 'present|numeric',
        self::COLUMN_SELL_PRICE                 => 'present|numeric',
        self::COLUMN_LIST_PRICE                 => 'present|numeric',
        self::COLUMN_CURRENCY                   => 'present',
    ];

    /**
     * Price constructor.
     *
     * @param array $data
     *
     * @throws EntityValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->priceBandArrowsphereSku = $data[self::COLUMN_PRICE_BAND_ARROWSPHERE_SKU];
        $this->buyPrice = $data[self::COLUMN_BUY_PRICE];
        $this->sellPrice = $data[self::COLUMN_SELL_PRICE];
        $this->listPrice = $data[self::COLUMN_LIST_PRICE];
        $this->currency = $data[self::COLUMN_CURRENCY];
    }

    /**
     * @return string|null
     */
    public function getPriceBandArrowsphereSku(): ?string
    {
        return $this->priceBandArrowsphereSku;
    }

    /**
     * @return float
     */
    public function getBuyPrice(): float
    {
        return $this->buyPrice;
    }

    /**
     * @return float
     */
    public function getSellPrice(): float
    {
        return $this->sellPrice;
    }

    /**
     * @return float
     */
    public function getListPrice(): float
    {
        return $this->listPrice;
    }

    /**
     * @return string|null
     */
    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_PRICE_BAND_ARROWSPHERE_SKU => $this->priceBandArrowsphereSku,
            self::COLUMN_BUY_PRICE                  => $this->buyPrice,
            self::COLUMN_SELL_PRICE                 => $this->sellPrice,
            self::COLUMN_LIST_PRICE                 => $this->listPrice,
            self::COLUMN_CURRENCY                   => $this->currency,
        ];
    }
}
