<?php

namespace ArrowSphere\PublicApiClient\Catalog\Entities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

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

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_ASSOCIATED_SUBSCRIPTION_PROGRAM, required: true)]
    protected string $associatedSubscriptionProgram;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_CLASSIFICATION, required: true)]
    protected string $classification;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_DESCRIPTION)]
    protected string $description = '';

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_NAME, required: true)]
    protected string $name;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_PROGRAM, required: true)]
    protected string $program;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_REFERENCE, required: true)]
    protected string $reference;

    /**
     * @var string[]
     */
    #[Property(name: self::COLUMN_SERVICE_TAGS, isArray: true)]
    protected array $serviceTags = [];

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
}
