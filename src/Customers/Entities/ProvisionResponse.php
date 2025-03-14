<?php

namespace ArrowSphere\PublicApiClient\Customers\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;

class ProvisionResponse extends AbstractEntity
{
    public const COLUMN_STATUS = 'status';
    public const COLUMN_MESSAGE = 'message';
    public const COLUMN_ATTRIBUTES = 'attributes';

    protected const VALIDATION_RULES = [
        self::COLUMN_STATUS     => 'required|string',
        self::COLUMN_MESSAGE    => 'required|string',
        self::COLUMN_ATTRIBUTES => 'required|array',
    ];

    private string $status;
    private string $message;

    /**
     * @var \ArrowSphere\PublicApiClient\Customers\Entities\Attribute[]
     */
    private array $attributes;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->status = $data[self::COLUMN_STATUS];
        $this->message = $data[self::COLUMN_MESSAGE];
        $this->attributes = array_map(static fn (array $attribute) => new Attribute($attribute), $data[self::COLUMN_ATTRIBUTES]);
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_STATUS     => $this->status,
            self::COLUMN_MESSAGE    => $this->message,
            self::COLUMN_ATTRIBUTES => array_map(static fn (Attribute $attribute) => $attribute->jsonSerialize(), $this->attributes),
        ];
    }
}
