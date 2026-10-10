<?php

namespace ArrowSphere\PublicApiClient\Customers\Entities\Invitation;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

/**
 * Class Company
 */
class Company extends AbstractEntity
{
    public const COLLUMN_REFERENCE = 'reference';

    /**
     * @var string
     */
    #[Property(name: self::COLLUMN_REFERENCE, required: true)]
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
