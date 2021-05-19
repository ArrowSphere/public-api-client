<?php

namespace ArrowSphere\PublicApiClient\Billing\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

class Identity extends AbstractEntity
{
    public const COLUMN_REFERENCE = 'reference';
    public const COLUMN_NAME = 'name';

    protected const VALIDATION_RULES = parent::VALIDATION_RULES + [
        self::COLUMN_REFERENCE => 'string|required',
        self::COLUMN_NAME => 'string|required',
    ];

    /**
     * @var string
     */
    private $reference;

    /**
     * @var string
     */
    private $name;

    /**
     * Identity constructor.
     *
     * @param array $data
     *
     * @throws EntityValidationException
     * @throws \ReflectionException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->reference = $data[self::COLUMN_REFERENCE];
        $this->name = $data[self::COLUMN_NAME];
    }

    /**
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_REFERENCE => $this->getReference(),
            self::COLUMN_NAME => $this->getName(),
        ];
    }
}
