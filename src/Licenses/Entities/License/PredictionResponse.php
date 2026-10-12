<?php

namespace ArrowSphere\PublicApiClient\Licenses\Entities\License;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

/**
 * Class PredictionResponse
 */
class PredictionResponse extends AbstractEntity
{
    public const COLUMN_AMOUNT = 'amount';
    public const COLUMN_DATE = 'date';

    /**
     * @var float
     */
    #[Property(name: self::COLUMN_AMOUNT, type: 'float', required: true)]
    protected float $amount;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_DATE, required: true)]
    protected string $date;

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }
}
