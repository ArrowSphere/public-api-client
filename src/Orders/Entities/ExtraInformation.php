<?php

namespace ArrowSphere\PublicApiClient\Orders\Entities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

class ExtraInformation extends AbstractEntity
{
    public const COLUMN_PROGRAMS = 'programs';

    /**
     * @var array
     */
    #[Property(name: self::COLUMN_PROGRAMS, type: 'array')]
    protected array $programs = [];

    /**
     * @return array
     */
    public function getPrograms(): array
    {
        return $this->programs;
    }
}
