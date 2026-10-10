<?php

namespace ArrowSphere\PublicApiClient\Licenses\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;

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

    /**
     * FilterFindResult constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->name = $data[self::COLUMN_NAME];
        $this->values = $data[self::COLUMN_VALUES];
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

    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_NAME   => $this->getName(),
            self::COLUMN_VALUES => $this->getValues()
        ];
    }
}
