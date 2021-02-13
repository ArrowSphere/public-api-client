<?php

namespace ArrowSphere\PublicApiClient\Catalog\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

/**
 * Class Program
 */
class Program extends AbstractEntity
{
    public const COLUMN_ASSOCIATED_SUBSCRIPTION_PROGRAM = 'associatedSubscriptionProgram';

    public const COLUMN_CLASSIFICATION = 'category';

    public const COLUMN_LOGO = 'logo';

    public const COLUMN_NAME = 'name';

    public const COLUMN_REFERENCE = 'reference';

    protected const VALIDATION_RULES = [
        self::COLUMN_ASSOCIATED_SUBSCRIPTION_PROGRAM => 'required',
        self::COLUMN_CLASSIFICATION                  => 'required',
        self::COLUMN_LOGO                            => 'present',
        self::COLUMN_NAME                            => 'required',
        self::COLUMN_REFERENCE                       => 'required',
    ];

    /**
     * @var string
     */
    private $associatedSubscriptionProgram;

    /**
     * @var string
     */
    private $classification;

    /**
     * @var string
     */
    private $logo;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $reference;

    /**
     * Program constructor.
     *
     * @param array $data
     *
     * @throws EntityValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->associatedSubscriptionProgram = $data[self::COLUMN_ASSOCIATED_SUBSCRIPTION_PROGRAM];
        $this->classification = $data[self::COLUMN_CLASSIFICATION];
        $this->logo = $data[self::COLUMN_LOGO];
        $this->name = $data[self::COLUMN_NAME];
        $this->reference = $data[self::COLUMN_REFERENCE];
    }

    /**
     * @return string
     */
    public function getAssociatedSubscriptionProgram(): string
    {
        return $this->associatedSubscriptionProgram;
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
    public function getLogo(): string
    {
        return $this->logo;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    public function jsonSerialize()
    {
        return [
            self::COLUMN_ASSOCIATED_SUBSCRIPTION_PROGRAM => $this->getAssociatedSubscriptionProgram(),
            self::COLUMN_CLASSIFICATION                  => $this->getClassification(),
            self::COLUMN_LOGO                            => $this->getLogo(),
            self::COLUMN_NAME                            => $this->getName(),
            self::COLUMN_REFERENCE                       => $this->getReference()
        ];
    }
}
