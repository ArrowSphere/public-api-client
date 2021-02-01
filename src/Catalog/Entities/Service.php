<?php

namespace ArrowSphere\PublicApiClient\Catalog\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

/**
 * Class Service
 *
 * @deprecated use the Family entity instead
 */
class Service extends AbstractEntity
{
    public const COLUMN_ASSOCIATED_SUBSCRIPTION_PROGRAM = 'associatedSubscriptionProgram';

    public const COLUMN_CLASSIFICATION = 'category';

    public const COLUMN_DESCRIPTION = 'description';

    public const COLUMN_NAME = 'name';

    public const COLUMN_PROGRAM = 'program';

    public const COLUMN_REFERENCE = 'reference';

    public const COLUMN_SERVICE_TAGS = 'serviceTags';

    protected const VALIDATION_RULES = [
        self::COLUMN_ASSOCIATED_SUBSCRIPTION_PROGRAM => 'required',
        self::COLUMN_CLASSIFICATION                  => 'required',
        self::COLUMN_NAME                            => 'required',
        self::COLUMN_PROGRAM                         => 'required',
        self::COLUMN_REFERENCE                       => 'required',
        self::COLUMN_SERVICE_TAGS                    => 'present|array',
    ];

    /** @var string */
    private $associatedSubscriptionProgram;

    /** @var string */
    private $classification;

    /** @var string */
    private $description;

    /** @var string */
    private $name;

    /** @var string */
    private $program;

    /** @var string */
    private $reference;

    /** @var string[] */
    private $serviceTags;

    /**
     * Service constructor.
     *
     * @param array $data
     * @throws EntityValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->associatedSubscriptionProgram = $data[self::COLUMN_ASSOCIATED_SUBSCRIPTION_PROGRAM];
        $this->classification = $data[self::COLUMN_CLASSIFICATION];
        $this->description = $data[self::COLUMN_DESCRIPTION] ?? '';
        $this->name = $data[self::COLUMN_NAME];
        $this->program = $data[self::COLUMN_PROGRAM];
        $this->reference = $data[self::COLUMN_REFERENCE];
        $this->serviceTags = $data[self::COLUMN_SERVICE_TAGS];
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
    public function getDescription(): string
    {
        return $this->description;
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
    public function getProgram(): string
    {
        return $this->program;
    }

    /**
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * @return string[]
     */
    public function getServiceTags(): array
    {
        return $this->serviceTags;
    }

    public function jsonSerialize()
    {
        return [
            self::COLUMN_ASSOCIATED_SUBSCRIPTION_PROGRAM => $this->getAssociatedSubscriptionProgram(),
            self::COLUMN_CLASSIFICATION                  => $this->getClassification(),
            self::COLUMN_DESCRIPTION                     => $this->getDescription(),
            self::COLUMN_NAME                            => $this->getName(),
            self::COLUMN_PROGRAM                         => $this->getProgram(),
            self::COLUMN_REFERENCE                       => $this->getReference(),
            self::COLUMN_SERVICE_TAGS                    => $this->getServiceTags(),
        ];
    }
}
