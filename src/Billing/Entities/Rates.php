<?php

namespace ArrowSphere\PublicApiClient\Billing\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity as LegacyAbstractEntity;
use ArrowSphere\PublicApiClient\Billing\Enum\RateTypeEnum;
use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Exception\EntitiesException;
use ArrowSphere\PublicApiClient\Entities\Property;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

class Rates extends AbstractEntity
{
    public const COLUMN_SELL_RATE = 'sellRate';
    public const COLUMN_SELL_RATE_TYPE = 'sellRateType';

    /**
     * @var float|null
     */
    #[Property(name: self::COLUMN_SELL_RATE, type: 'float', serializeNull: true)]
    protected ?float $sellRate = null;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_SELL_RATE_TYPE, serializeNull: true)]
    protected ?string $sellRateType = null;

    /**
     * Rates constructor.
     *
     * @param array $data
     *
     * @throws EntitiesException
     * @throws EntityValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        if (LegacyAbstractEntity::$enableValidation && $this->sellRateType !== null && ! RateTypeEnum::isValidValue($this->sellRateType)) {
            throw new EntityValidationException('End Customer Rate type: ' . $this->sellRateType . ' not supported');
        }
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
}
