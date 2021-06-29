<?php

namespace ArrowSphere\PublicApiClient\Billing\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

class Prices extends AbstractEntity
{
    public const COLUMN_LIST_UNIT = 'listUnit';
    public const COLUMN_LIST_TOTAL = 'listTotal';
    public const COLUMN_BUY_UNIT = 'buyUnit';
    public const COLUMN_BUY_TOTAL = 'buyTotal';
    public const COLUMN_SELL_UNIT = 'sellUnit';
    public const COLUMN_SELL_TOTAL = 'sellTotal';

    protected const VALIDATION_RULES = parent::VALIDATION_RULES + [
        self::COLUMN_LIST_UNIT => 'numeric|nullable',
        self::COLUMN_LIST_TOTAL => 'numeric|nullable',
        self::COLUMN_BUY_UNIT => 'numeric|nullable',
        self::COLUMN_BUY_TOTAL => 'numeric|required',
        self::COLUMN_SELL_UNIT => 'numeric|nullable',
        self::COLUMN_SELL_TOTAL => 'numeric|required',
    ];

    /**
     * @var float|null
     */
    private $listUnit;

    /**
     * @var float|null
     */
    private $listTotal;

    /**
     * @var float|null
     */
    private $buyUnit;

    /**
     * @var float
     */
    private $buyTotal;

    /**
     * @var float|null
     */
    private $sellUnit;

    /**
     * @var float
     */
    private $sellTotal;

    /**
     * Identity constructor.
     *
     * @param array $data
     *
     * @throws EntityValidationException
     * @throws \ReflectionException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->listUnit = $data[self::COLUMN_LIST_UNIT] ?? null;
        $this->listTotal = $data[self::COLUMN_LIST_TOTAL] ?? null;
        $this->buyUnit = $data[self::COLUMN_BUY_UNIT] ?? null;
        $this->buyTotal = $data[self::COLUMN_BUY_TOTAL];
        $this->sellUnit = $data[self::COLUMN_SELL_UNIT] ?? null;
        $this->sellTotal = $data[self::COLUMN_SELL_TOTAL];
    }

    /**
     * @return float
     */
    public function getListUnit(): ?float
    {
        return $this->listUnit;
    }

    /**
     * @return float
     */
    public function getListTotal(): ?float
    {
        return $this->listTotal;
    }

    /**
     * @return float
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
     * @return float
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

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return array_filter([
            self::COLUMN_LIST_UNIT => $this->getListUnit(),
            self::COLUMN_LIST_TOTAL => $this->getListTotal(),
            self::COLUMN_BUY_UNIT => $this->getBuyUnit(),
            self::COLUMN_BUY_TOTAL => $this->getBuyTotal(),
            self::COLUMN_SELL_UNIT => $this->getSellUnit(),
            self::COLUMN_SELL_TOTAL => $this->getSellTotal(),
        ], static function ($value) {
            return $value !== null;
        });
    }
}
