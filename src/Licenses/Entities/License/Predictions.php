<?php

namespace ArrowSphere\PublicApiClient\Licenses\Entities\License;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

/**
 * Class Predictions
 */
class Predictions extends AbstractEntity
{
    public const COLUMN_CURRENCY = 'currency';
    public const COLUMN_UPDATED_AT = 'updatedAt';
    public const COLUMN_LICENSE_REFERENCE = 'licenseReference';
    public const COLUMN_PREDICTIONS = 'predictions';
    protected const VALIDATION_RULES = [
        self::COLUMN_CURRENCY => 'present',
        self::COLUMN_UPDATED_AT => 'present',
        self::COLUMN_LICENSE_REFERENCE => 'present',
        self::COLUMN_PREDICTIONS =>'present'
    ];

    /**
     * @var string
     */
    private $currency;

    /**
     * @var string
     */
    private $updatedAt;

    /**
     * @var string
     */
    private $licenseReference;

    /**
     * @var PredictionResponse[]
     */
    private $prediction;

    /**
     * Predictions constructor
     *
     * @param array $data
     *
     * @throws  EntityValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->currency = $data[self::COLUMN_CURRENCY];
        $this->updatedAt = $data[self::COLUMN_UPDATED_AT];
        $this->licenseReference = $data[self::COLUMN_LICENSE_REFERENCE];
        $this->prediction = $data[self::COLUMN_PREDICTIONS];
    }

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
        return $this->prediction;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_CURRENCY => $this->getCurrency(),
            self::COLUMN_UPDATED_AT => $this->getUpdatedAt(),
            self::COLUMN_LICENSE_REFERENCE => $this->getLicenseReference(),
            self::COLUMN_PREDICTIONS => $this->getPredictionResponse(),
        ];
    }
}
