<?php

namespace ArrowSphere\PublicApiClient\Consumption\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Consumption\Enum\ColorEnum;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;
use ArrowSphere\PublicApiClient\General\Enum\ClassificationEnum;

class HealthCheckItem extends AbstractEntity
{
    public const COLUMN_VENDOR = 'vendor';
    public const COLUMN_MARKETPLACE = 'marketplace';
    public const COLUMN_CLASSIFICATION = 'classification';
    public const COLUMN_COLOR = 'color';
    public const COLUMN_MESSAGE = 'message';

    protected const VALIDATION_RULES = parent::VALIDATION_RULES + [
        self::COLUMN_VENDOR         => 'string|required',
        self::COLUMN_MARKETPLACE    => 'string|required',
        self::COLUMN_CLASSIFICATION => 'string|required',
        self::COLUMN_COLOR          => 'string|required',
        self::COLUMN_MESSAGE        => 'string|required',
    ];

    /**
     * @var string
     */
    private $vendor;

    /**
     * @var string
     */
    private $marketPlace;

    /**
     * @var string
     */
    private $classification;

    /**
     * @var string
     */
    private $color;

    /**
     * @var string
     */
    private $message;

    /**
     * HealthCheckItem constructor.
     *
     * @param array $data
     *
     * @throws EntityValidationException
     * @throws \ReflectionException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        if (! ColorEnum::isValidName($data[self::COLUMN_COLOR])) {
            throw new EntityValidationException('Color: ' . $data[self::COLUMN_COLOR] . ' not supported');
        }

        if (! ClassificationEnum::isValidName($data[self::COLUMN_CLASSIFICATION])) {
            throw new EntityValidationException('Classification: ' . $data[self::COLUMN_CLASSIFICATION] . ' not supported');
        }

        $this->color = $data[self::COLUMN_COLOR];
        $this->vendor = $data[self::COLUMN_VENDOR];
        $this->marketPlace = $data[self::COLUMN_MARKETPLACE];
        $this->classification = $data[self::COLUMN_CLASSIFICATION];
        $this->message = $data[self::COLUMN_MESSAGE];
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

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            self::COLUMN_VENDOR => $this->getVendor(),
            self::COLUMN_MARKETPLACE => $this->getMarketPlace(),
            self::COLUMN_CLASSIFICATION => $this->getClassification(),
            self::COLUMN_COLOR => $this->getColor(),
            self::COLUMN_MESSAGE => $this->getMessage()
        ];
    }
}
