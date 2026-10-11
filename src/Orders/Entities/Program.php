<?php

namespace ArrowSphere\PublicApiClient\Orders\Entities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

class Program extends AbstractEntity
{
    public const COLUMN_LEGACY_CODE = 'legacyCode';

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_LEGACY_CODE, required: true)]
    protected string $legacyCode;

    /**
     * @return string
     */
    public function getLegacyCode(): string
    {
        return $this->legacyCode;
    }
}
