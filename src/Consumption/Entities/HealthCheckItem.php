<?php

namespace ArrowSphere\PublicApiClient\Consumption\Entities;

use ArrowSphere\PublicApiClient\Consumption\Enum\ColorEnum;
use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Exception\EntitiesException;
use ArrowSphere\PublicApiClient\Entities\Property;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;
use ArrowSphere\PublicApiClient\General\Enum\ClassificationEnum;

class HealthCheckItem extends AbstractEntity
{
    public const COLUMN_VENDOR = 'vendor';
    public const COLUMN_MARKETPLACE = 'marketplace';
    public const COLUMN_CLASSIFICATION = 'classification';
    public const COLUMN_COLOR = 'color';
    public const COLUMN_MESSAGE = 'message';

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_VENDOR, required: true)]
    protected string $vendor;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_MARKETPLACE, required: true)]
    protected string $marketPlace;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_CLASSIFICATION, required: true)]
    protected string $classification;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_COLOR, required: true)]
    protected string $color;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_MESSAGE, required: true)]
    protected string $message;

    /**
     * HealthCheckItem constructor.
     *
     * @param array $data
     *
     * @throws EntitiesException
     * @throws EntityValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        if (! ColorEnum::isValidName($this->color)) {
            throw new EntityValidationException('Color: ' . $this->color . ' not supported');
        }

        if (! ClassificationEnum::isValidName($this->classification)) {
            throw new EntityValidationException('Classification: ' . $this->classification . ' not supported');
        }
    }

    /**
     * @return string
     */
    public function getVendor(): string
    {
        return $this->vendor;
    }

    /**
     * @return string
     */
    public function getMarketPlace(): string
    {
        return $this->marketPlace;
    }

    /**
     * @return string
     */
    public function getClassification(): string
    {
        return $this->classification;
    }

    /**
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
}
