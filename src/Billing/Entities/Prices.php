<?php

namespace ArrowSphere\PublicApiClient\Billing\Entities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

class Prices extends AbstractEntity
{
    public const COLUMN_LIST_UNIT = 'listUnit';
    public const COLUMN_LIST_TOTAL = 'listTotal';
    public const COLUMN_BUY_UNIT = 'buyUnit';
    public const COLUMN_BUY_TOTAL = 'buyTotal';
    public const COLUMN_SELL_UNIT = 'sellUnit';
    public const COLUMN_SELL_TOTAL = 'sellTotal';

    /**
     * @var float|null
     */
    #[Property(name: self::COLUMN_LIST_UNIT, type: 'float')]
    protected ?float $listUnit = null;

    /**
     * @var float|null
     */
    #[Property(name: self::COLUMN_LIST_TOTAL, type: 'float')]
    protected ?float $listTotal = null;

    /**
     * @var float|null
     */
    #[Property(name: self::COLUMN_BUY_UNIT, type: 'float')]
    protected ?float $buyUnit = null;

    /**
     * @var float
     */
    #[Property(name: self::COLUMN_BUY_TOTAL, type: 'float', required: true)]
    protected float $buyTotal;

    /**
     * @var float|null
     */
    #[Property(name: self::COLUMN_SELL_UNIT, type: 'float')]
    protected ?float $sellUnit = null;

    /**
     * @var float
     */
    #[Property(name: self::COLUMN_SELL_TOTAL, type: 'float', required: true)]
    protected float $sellTotal;

    /**
     * @return float|null
     */
    public function getListUnit(): ?float
    {
        return $this->listUnit;
    }

    /**
     * @return float|null
     */
    public function getListTotal(): ?float
    {
        return $this->listTotal;
    }

    /**
     * @return float|null
     */
    public function getBuyUnit(): ?float
    {
        return $this->buyUnit;
    }

    /**
     * @return float
     */
    public function getBuyTotal(): float
    {
        return $this->buyTotal;
    }

    /**
     * @return float|null
     */
    public function getSellUnit(): ?float
    {
        return $this->sellUnit;
    }

    /**
     * @return float
     */
    public function getSellTotal(): float
    {
        return $this->sellTotal;
    }
}
