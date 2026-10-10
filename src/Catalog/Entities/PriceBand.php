<?php

namespace ArrowSphere\PublicApiClient\Catalog\Entities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Exception\EntitiesException;
use ArrowSphere\PublicApiClient\Entities\Property;

/**
 * Class PriceBand
 */
class PriceBand extends AbstractEntity
{
    public const COLUMN_MIN_QUANTITY = 'min_quantity';

    public const COLUMN_MAX_QUANTITY = 'max_quantity';

    public const COLUMN_RECURRING_BUY_PRICE = 'recurring_buy_price';

    public const COLUMN_RECURRING_SELL_PRICE = 'recurring_sell_price';

    public const COLUMN_ARROW_PRICE = 'arrow_price';

    public const COLUMN_TERM = 'term';

    public const COLUMN_UNIT_TYPE = 'unit_type';

    public const COLUMN_RECURRING_TIME_UNIT = 'recurring_time_unit';

    public const COLUMN_CURRENCY = 'currency';

    public const COLUMN_PERIOD_AS_HOURS = 'period_as_hours';

    public const COLUMN_TERM_AS_HOURS = 'term_as_hours';

    /**
     * @var int
     */
    #[Property(name: self::COLUMN_MIN_QUANTITY, type: 'int', required: true)]
    protected int $minQuantity;

    /**
     * @var int|null
     */
    #[Property(name: self::COLUMN_MAX_QUANTITY, type: 'int', serializeNull: true)]
    protected ?int $maxQuantity = null;

    /**
     * @var float
     */
    #[Property(name: self::COLUMN_RECURRING_BUY_PRICE, type: 'float', required: true)]
    protected float $recurringBuyPrice;

    /**
     * @var float
     */
    #[Property(name: self::COLUMN_RECURRING_SELL_PRICE, type: 'float', required: true)]
    protected float $recurringSellPrice;

    /**
     * @var float|null
     */
    #[Property(name: self::COLUMN_ARROW_PRICE, type: 'float', serializeNull: true)]
    protected ?float $arrowPrice = null;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_TERM, required: true)]
    protected string $term;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_UNIT_TYPE, required: true)]
    protected string $unitType;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_RECURRING_TIME_UNIT, required: true)]
    protected string $recurringTimeUnit;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_CURRENCY, required: true)]
    protected string $currency;

    /**
     * @var int
     */
    #[Property(name: self::COLUMN_PERIOD_AS_HOURS, type: 'int', required: true)]
    protected int $periodAsHours;

    /**
     * @var int
     */
    #[Property(name: self::COLUMN_TERM_AS_HOURS, type: 'int', required: true)]
    protected int $termAsHours;

    /**
     * PriceBand constructor.
     *
     * @param array $data
     *
     * @throws EntitiesException
     */
    public function __construct(array $data)
    {
        // The API returns "Infinity" when there is no maximum quantity
        if (($data[self::COLUMN_MAX_QUANTITY] ?? null) === 'Infinity') {
            $data[self::COLUMN_MAX_QUANTITY] = null;
        }

        parent::__construct($data);
    }

    /**
     * @return int
     */
    public function getMinQuantity(): int
    {
        return $this->minQuantity;
    }

    /**
     * @return int|null
     */
    public function getMaxQuantity(): ?int
    {
        return $this->maxQuantity;
    }

    /**
     * @return float
     */
    public function getRecurringBuyPrice(): float
    {
        return $this->recurringBuyPrice;
    }

    /**
     * @return float
     */
    public function getRecurringSellPrice(): float
    {
        return $this->recurringSellPrice;
    }

    /**
     * @return float|null
     */
    public function getArrowPrice(): ?float
    {
        return $this->arrowPrice;
    }

    /**
     * @return string
     */
    public function getTerm(): string
    {
        return $this->term;
    }

    /**
     * @return string
     */
    public function getUnitType(): string
    {
        return $this->unitType;
    }

    /**
     * @return string
     */
    public function getRecurringTimeUnit(): string
    {
        return $this->recurringTimeUnit;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @return int
     */
    public function getPeriodAsHours(): int
    {
        return $this->periodAsHours;
    }

    /**
     * @return int
     */
    public function getTermAsHours(): int
    {
        return $this->termAsHours;
    }
}
