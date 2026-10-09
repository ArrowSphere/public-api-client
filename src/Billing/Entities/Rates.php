<?php

namespace ArrowSphere\PublicApiClient\Billing\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;

class Rates extends AbstractEntity
{
    public const COLUMN_SELL_RATE = 'sellRate';
    public const COLUMN_SELL_RATE_TYPE = 'sellRateType';

    /**
     * @var float|null
     */
    private $sellRate;

    /**
     * @var string|null
     */
    private $sellRateType;

    /**
     * Identity constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->sellRate = $data[self::COLUMN_SELL_RATE];
        $this->sellRateType = $data[self::COLUMN_SELL_RATE_TYPE];
    }

    /**
     * @return float
     */
    public function getSellRate(): ?float
    {
        return $this->sellRate;
    }

    /**
     * @return string|null
     */
    public function getSellRateType(): ?string
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
