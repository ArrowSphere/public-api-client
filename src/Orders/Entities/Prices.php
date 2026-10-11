<?php

namespace ArrowSphere\PublicApiClient\Orders\Entities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

class Prices extends AbstractEntity
{
    public const COLUMN_BUY = 'buy';

    public const COLUMN_SELL = 'sell';

    public const COLUMN_CURRENCY = 'currency';

    public const COLUMN_PERIODICITY = 'periodicity';

    public const COLUMN_TERM = 'term';

    public const COLUMN_PERIODICITY_CODE = 'periodicityCode';

    public const COLUMN_TERM_CODE = 'termCode';

    /**
     * @var float
     */
    #[Property(name: self::COLUMN_BUY, type: 'float', required: true)]
    protected float $buy;

    /**
     * @var float
     */
    #[Property(name: self::COLUMN_SELL, type: 'float', required: true)]
    protected float $sell;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_CURRENCY, required: true)]
    protected string $currency;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_PERIODICITY, required: true)]
    protected string $periodicity;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_TERM, required: true)]
    protected string $term;

    /**
     * @var int
     */
    #[Property(name: self::COLUMN_PERIODICITY_CODE, type: 'int', required: true)]
    protected int $periodicityCode;

    /**
     * @var int
     */
    #[Property(name: self::COLUMN_TERM_CODE, type: 'int', required: true)]
    protected int $termCode;

    /**
     * @return float
     */
    public function getBuy(): float
    {
        return $this->buy;
    }

    /**
     * @return float
     */
    public function getSell(): float
    {
        return $this->sell;
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
    public function getPeriodicity(): string
    {
        return $this->periodicity;
    }

    /**
     * @return string
     */
    public function getTerm(): string
    {
        return $this->term;
    }

    /**
     * @return int
     */
    public function getPeriodicityCode(): int
    {
        return $this->periodicityCode;
    }

    /**
     * @return int
     */
    public function getTermCode(): int
    {
        return $this->termCode;
    }
}
