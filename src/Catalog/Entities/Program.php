<?php

namespace ArrowSphere\PublicApiClient\Catalog\Entities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

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
     * @var string|null
     */
    #[Property(name: self::COLUMN_LOGO, serializeNull: true)]
    protected ?string $logo = null;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_NAME, required: true)]
    protected string $name;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_REFERENCE, required: true)]
    protected string $reference;

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
     * @return string|null
     */
    public function getLogo(): ?string
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
}
