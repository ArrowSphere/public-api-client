<?php

namespace ArrowSphere\PublicApiClient\Billing\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

class ErpExportType extends AbstractEntity
{
    public const COLUMN_NAME = 'name';

    public const COLUMN_COLUMNS = 'columns';

    protected const VALIDATION_RULES = parent::VALIDATION_RULES + [
        self::COLUMN_NAME => 'string|required',
        self::COLUMN_COLUMNS => 'array|required',
    ];

    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $columns;

    /**
     * Erp Export Type constructor.
     *
     * @param array $data
     *
     * @throws EntityValidationException
     * @throws \ReflectionException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->name = $data[self::COLUMN_NAME];
        $this->columns = $data[self::COLUMN_COLUMNS];
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
    public function getColumns(): array
    {
        return $this->columns;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_NAME => $this->getName(),
            self::COLUMN_COLUMNS => $this->getColumns(),
        ];
    }
}
