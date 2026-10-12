<?php

namespace ArrowSphere\PublicApiClient\Customers\Entities\Invitation;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

/**
 * Class Company
 */
class Company extends AbstractEntity
{
    public const COLUMN_REFERENCE = 'reference';

    /**
     * @deprecated use COLUMN_REFERENCE, this constant has a typo
     */
    public const COLLUMN_REFERENCE = self::COLUMN_REFERENCE;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_REFERENCE, required: true)]
    protected string $reference;

    /**
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     *
     * @return static
     */
    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }
}
