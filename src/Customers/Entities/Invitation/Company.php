<?php

namespace ArrowSphere\PublicApiClient\Customers\Entities\Invitation;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

/**
 * Class Company
 */
class Company extends AbstractEntity
{
    public const COLLUMN_REFERENCE = 'reference';

    protected const VALIDATION_RULES = parent::VALIDATION_RULES + [
        self::COLLUMN_REFERENCE => 'required',
    ];

    /**
     * @var string
     */
    private $reference;

    /**
     * @param array $data
     *
     * @throws EntityValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->reference = $data[self::COLLUMN_REFERENCE];
    }

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

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            self::COLLUMN_REFERENCE => $this->reference,
        ];
    }
}
