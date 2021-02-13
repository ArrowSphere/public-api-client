<?php

namespace ArrowSphere\PublicApiClient\Catalog\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

/**
 * Class Classification
 */
class Classification extends AbstractEntity
{
    public const COLUMN_NAME = 'name';

    protected const VALIDATION_RULES = [
        self::COLUMN_NAME => 'required',
    ];

    /**
     * @var string
     */
    private $name;

    /**
     * Classification constructor.
     *
     * @param array $data
     *
     * @throws EntityValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->name = $data[self::COLUMN_NAME];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    public function jsonSerialize()
    {
        return $this->name;
    }
}
