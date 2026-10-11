<?php

namespace ArrowSphere\PublicApiClient\Billing\Entities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

class ErpExportType extends AbstractEntity
{
    public const COLUMN_NAME = 'name';

    public const COLUMN_COLUMNS = 'columns';

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_NAME, required: true)]
    protected string $name;

    /**
     * @var array
     */
    #[Property(name: self::COLUMN_COLUMNS, type: 'array', required: true)]
    protected array $columns;

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
}
