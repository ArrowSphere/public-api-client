<?php

namespace ArrowSphere\PublicApiClient\Licenses\Entities\License;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

/**
 * Class Predictions
 */
class Predictions extends AbstractEntity
{
    public const COLUMN_CURRENCY = 'currency';
    public const COLUMN_UPDATED_AT = 'updatedAt';
    public const COLUMN_LICENSE_REFERENCE = 'licenseReference';
    public const COLUMN_PREDICTIONS = 'predictions';

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_CURRENCY, required: true)]
    protected string $currency;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_UPDATED_AT, required: true)]
    protected string $updatedAt;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_LICENSE_REFERENCE, required: true)]
    protected string $licenseReference;

    /**
     * @var array
     */
    #[Property(name: self::COLUMN_PREDICTIONS, type: 'array')]
    protected array $predictions = [];

    /**
     * Predictions constructor
     *
     * @return  string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    /**
     * @return string
     */
    public function getLicenseReference(): string
    {
        return $this->licenseReference;
    }

    /**
     * @return array
     */
    public function getPredictionResponse(): array
    {
        return $this->predictions;
    }
}
