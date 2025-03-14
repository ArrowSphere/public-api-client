<?php

namespace ArrowSphere\PublicApiClient\Customers\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;

class Attribute extends AbstractEntity
{
    public const COLUMN_SCHEDULED_NAME = 'name';
    public const COLUMN_VALUE = 'value';

    protected string $name;

    protected string $value;

    protected const VALIDATION_RULES = [
        self::COLUMN_SCHEDULED_NAME => 'required|string',
        self::COLUMN_VALUE          => 'required|string',
    ];

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->value = $data['value'];
        $this->name = $data['name'];
    }

    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_SCHEDULED_NAME => $this->name,
            self::COLUMN_VALUE          => $this->value,
        ];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
