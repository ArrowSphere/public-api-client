<?php

namespace ArrowSphere\PublicApiClient\Orders\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;

class Program extends AbstractEntity
{
    public const COLUMN_LEGACY_CODE = 'legacyCode';

    /**
     * @var string Program legacy code
     */
    private string $legacyCode;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->legacyCode = $data[self::COLUMN_LEGACY_CODE];
    }

    public function jsonSerialize(): array
    {
        return [self::COLUMN_LEGACY_CODE => $this->legacyCode];
    }

    public function getLegacyCode(): string
    {
        return $this->legacyCode;
    }
}
