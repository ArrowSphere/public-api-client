<?php

namespace ArrowSphere\PublicApiClient\Licenses\Entities\License;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

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
    private $amount;

    /**
     * @var string
     */
    private $date;

    protected const VALIDATION_RULES = [
        self::COLUMN_DATE => 'present',
        self::COLUMN_AMOUNT => 'present',
    ];

    /**
     * PredictionResponse constructor
     *
     * @param array $data
     *
     * @throws  EntityValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->date = $data[self::COLUMN_DATE];
        $this->amount = $data[self::COLUMN_AMOUNT];
    }

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

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_DATE => $this->getDate(),
            self::COLUMN_AMOUNT => $this->getAmount(),
        ];
    }
}
