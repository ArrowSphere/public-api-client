<?php

namespace ArrowSphere\PublicApiClient\Catalog\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

/**
 * Class FilterFindResult
 */
class FilterFindResult extends AbstractEntity
{
    public const COLUMN_NAME = 'name';

    public const COLUMN_VALUES = 'values';

    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $values;

    protected const VALIDATION_RULES = [
        self::COLUMN_NAME                => 'present',
        self::COLUMN_VALUES              => 'present|array',
        self::COLUMN_VALUES . '.*.value' => 'present',
        self::COLUMN_VALUES . '.*.count' => 'required|numeric',
    ];

    /**
     * FilterFindResult constructor.
     *
     * @param array $data
     *
     * @throws EntityValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->name = $data['name'];
        $this->values = $data['values'];
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
    public function getValues(): array
    {
        return $this->values;
    }

    public function jsonSerialize()
    {
        return [
            self::COLUMN_NAME   => $this->getName(),
            self::COLUMN_VALUES => $this->getValues()
        ];
    }
}
