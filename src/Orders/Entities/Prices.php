<?php

namespace ArrowSphere\PublicApiClient\Orders\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;

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
     * @var float Price the product was bought
     */
    private float $buy;

    /**
     * @var float Price the product was sold
     */
    private float $sell;

    /**
     * @var string Currency
     */
    private string $currency;

    /**
     * @var string Product price periodicity
     */
    private string $periodicity;

    /**
     * @var string Billing term
     */
    private string $term;

    /**
     * @var int The periodicity code
     */
    private int $periodicityCode;

    /**
     * @var int The term code
     */
    private int $termCode;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->buy = $data[self::COLUMN_BUY];
        $this->sell = $data[self::COLUMN_SELL];
        $this->currency = $data[self::COLUMN_CURRENCY];
        $this->periodicity = $data[self::COLUMN_PERIODICITY];
        $this->term = $data[self::COLUMN_TERM];
        $this->periodicityCode = $data[self::COLUMN_PERIODICITY_CODE];
        $this->termCode = $data[self::COLUMN_TERM_CODE];
    }

    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_BUY              => $this->buy,
            self::COLUMN_SELL             => $this->sell,
            self::COLUMN_CURRENCY         => $this->currency,
            self::COLUMN_PERIODICITY      => $this->periodicity,
            self::COLUMN_TERM             => $this->term,
            self::COLUMN_PERIODICITY_CODE => $this->periodicityCode,
            self::COLUMN_TERM_CODE        => $this->termCode,
        ];
    }

    public function getBuy(): float
    {
        return $this->buy;
    }

    public function getSell(): float
    {
        return $this->sell;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getPeriodicity(): string
    {
        return $this->periodicity;
    }

    public function getTerm(): string
    {
        return $this->term;
    }

    public function getPeriodicityCode(): int
    {
        return $this->periodicityCode;
    }

    public function getTermCode(): int
    {
        return $this->termCode;
    }
}
