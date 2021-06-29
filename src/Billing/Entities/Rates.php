<?php

namespace ArrowSphere\PublicApiClient\Billing\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Billing\Enum\RateTypeEnum;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

class Rates extends AbstractEntity
{
    public const COLUMN_SELL_RATE = 'sellRate';
    public const COLUMN_SELL_RATE_TYPE = 'sellRateType';

    protected const VALIDATION_RULES = parent::VALIDATION_RULES + [
        self::COLUMN_SELL_RATE => 'numeric|present|nullable',
        self::COLUMN_SELL_RATE_TYPE => 'string|present|nullable',
    ];

    /**
     * @var float
     */
    private $sellRate;

    /**
     * @var string
     */
    private $sellRateType;

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

        if (! RateTypeEnum::isValidValue($data[self::COLUMN_SELL_RATE_TYPE])) {
            throw new EntityValidationException('End Customer Rate type: ' . $data[self::COLUMN_SELL_RATE_TYPE] . ' not supported');
        }

        $this->sellRate = $data[self::COLUMN_SELL_RATE];
        $this->sellRateType = $data[self::COLUMN_SELL_RATE_TYPE];
    }

    /**
     * @return float
     */
    public function getSellRate(): float
    {
        return $this->sellRate;
    }

    /**
     * @return string
     */
    public function getSellRateType(): string
    {
        return $this->sellRateType;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_SELL_RATE => $this->getSellRate(),
            self::COLUMN_SELL_RATE_TYPE => $this->getSellRateType(),
        ];
    }
}
