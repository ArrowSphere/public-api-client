<?php

namespace ArrowSphere\PublicApiClient\Catalog\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

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

    protected const VALIDATION_RULES = [
        self::COLUMN_MIN_QUANTITY         => 'required',
        self::COLUMN_MAX_QUANTITY         => 'present',
        self::COLUMN_RECURRING_BUY_PRICE  => 'required',
        self::COLUMN_RECURRING_SELL_PRICE => 'required',
        self::COLUMN_TERM                 => 'required',
        self::COLUMN_UNIT_TYPE            => 'required',
        self::COLUMN_RECURRING_TIME_UNIT  => 'required',
        self::COLUMN_CURRENCY             => 'required',
        self::COLUMN_PERIOD_AS_HOURS      => 'required|numeric',
        self::COLUMN_TERM_AS_HOURS        => 'required|numeric',
    ];

    /** @var int */
    private $minQuantity;

    /** @var int|null */
    private $maxQuantity;

    /** @var float */
    private $recurringBuyPrice;

    /** @var float */
    private $recurringSellPrice;

    /** @var float|null */
    private $arrowPrice;

    /** @var string */
    private $term;

    /** @var string */
    private $unitType;

    /** @var string */
    private $recurringTimeUnit;

    /** @var string */
    private $currency;

    /** @var int */
    private $periodAsHours;

    /** @var int */
    private $termAsHours;

    /**
     * PriceBand constructor.
     *
     * @param array $data
     * @throws EntityValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->minQuantity = $data[self::COLUMN_MIN_QUANTITY];
        $this->maxQuantity = $data[self::COLUMN_MAX_QUANTITY] === 'Infinity' ? null : $data[self::COLUMN_MAX_QUANTITY];
        $this->recurringBuyPrice = $data[self::COLUMN_RECURRING_BUY_PRICE];
        $this->recurringSellPrice = $data[self::COLUMN_RECURRING_SELL_PRICE];
        $this->arrowPrice = $data[self::COLUMN_ARROW_PRICE] ?? null;
        $this->term = $data[self::COLUMN_TERM];
        $this->unitType = $data[self::COLUMN_UNIT_TYPE];
        $this->recurringTimeUnit = $data[self::COLUMN_RECURRING_TIME_UNIT];
        $this->currency = $data[self::COLUMN_CURRENCY];
        $this->periodAsHours = $data[self::COLUMN_PERIOD_AS_HOURS];
        $this->termAsHours = $data[self::COLUMN_TERM_AS_HOURS];
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

    public function jsonSerialize()
    {
        return [
            self::COLUMN_MIN_QUANTITY         => $this->getMinQuantity(),
            self::COLUMN_MAX_QUANTITY         => $this->getMaxQuantity(),
            self::COLUMN_RECURRING_BUY_PRICE  => $this->getRecurringBuyPrice(),
            self::COLUMN_RECURRING_SELL_PRICE => $this->getRecurringSellPrice(),
            self::COLUMN_ARROW_PRICE          => $this->getArrowPrice(),
            self::COLUMN_TERM                 => $this->getTerm(),
            self::COLUMN_UNIT_TYPE            => $this->getUnitType(),
            self::COLUMN_RECURRING_TIME_UNIT  => $this->getRecurringTimeUnit(),
            self::COLUMN_CURRENCY             => $this->getCurrency(),
            self::COLUMN_PERIOD_AS_HOURS      => $this->getPeriodAsHours(),
            self::COLUMN_TERM_AS_HOURS        => $this->getTermAsHours(),
        ];
    }
}
