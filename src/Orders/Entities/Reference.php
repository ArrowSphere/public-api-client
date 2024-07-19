<?php

namespace ArrowSphere\PublicApiClient\Orders\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;

class Reference extends AbstractEntity
{
    public const COLUMN_REFERENCE = 'reference';

    /**
     * @var string ArrowSphere  reference ID
     */
    private string $reference;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->reference = $data[self::COLUMN_REFERENCE];
    }

    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_REFERENCE => $this->reference,
        ];
    }

    public function getReference(): string
    {
        return $this->reference;
    }
}
