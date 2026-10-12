<?php

namespace ArrowSphere\PublicApiClient\Licenses\Entities\License;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Exception\EntitiesException;
use ArrowSphere\PublicApiClient\Entities\Property;

/**
 * Class Price
 */
class Price extends AbstractEntity
{
    public const COLUMN_PRICE_BAND_ARROWSPHERE_SKU = 'priceBandArrowsphereSku';

    public const COLUMN_BUY_PRICE = 'buy_price';

    public const COLUMN_SELL_PRICE = 'sell_price';

    public const COLUMN_LIST_PRICE = 'list_price';

    public const COLUMN_TOTAL_BUY_PRICE = 'total_buy_price';

    public const COLUMN_TOTAL_SELL_PRICE = 'total_sell_price';

    public const COLUMN_TOTAL_LIST_PRICE = 'total_list_price';

    public const COLUMN_CURRENCY = 'currency';

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_PRICE_BAND_ARROWSPHERE_SKU, serializeNull: true)]
    protected ?string $priceBandArrowsphereSku = null;

    /**
     * @var float
     */
    #[Property(name: self::COLUMN_BUY_PRICE, type: 'float', required: true)]
    protected float $buyPrice;

    /**
     * @var float
     */
    #[Property(name: self::COLUMN_LIST_PRICE, type: 'float', required: true)]
    protected float $listPrice;

    /**
     * @var float
     */
    #[Property(name: self::COLUMN_SELL_PRICE, type: 'float', required: true)]
    protected float $sellPrice;

    /**
     * @var float Computed from the unit price and the quantity, a value in the data is ignored
     */
    #[Property(name: self::COLUMN_TOTAL_BUY_PRICE, type: 'float')]
    protected float $totalBuyPrice = 0.0;

    /**
     * @var float Computed from the unit price and the quantity, a value in the data is ignored
     */
    #[Property(name: self::COLUMN_TOTAL_LIST_PRICE, type: 'float')]
    protected float $totalListPrice = 0.0;

    /**
     * @var float Computed from the unit price and the quantity, a value in the data is ignored
     */
    #[Property(name: self::COLUMN_TOTAL_SELL_PRICE, type: 'float')]
    protected float $totalSellPrice = 0.0;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_CURRENCY, serializeNull: true)]
    protected ?string $currency = null;

    /**
     * Price constructor.
     *
     * @param array $data
     * @param int $qty The quantity the totals are computed for
     *
     * @throws EntitiesException
     */
    public function __construct(array $data, int $qty = 1)
    {
        parent::__construct($data);

        $this->totalListPrice = round($this->listPrice * $qty, 2);
        $this->totalBuyPrice = round($this->buyPrice * $qty, 2);
        $this->totalSellPrice = round($this->sellPrice * $qty, 2);
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
     * @return float
     */
    public function getTotalBuyPrice(): float
    {
        return $this->totalBuyPrice;
    }

    /**
     * @return float
     */
    public function getTotalSellPrice(): float
    {
        return $this->totalSellPrice;
    }

    /**
     * @return float
     */
    public function getTotalListPrice(): float
    {
        return $this->totalListPrice;
    }

    /**
     * @return string|null
     */
    public function getCurrency(): ?string
    {
        return $this->currency;
    }
}
