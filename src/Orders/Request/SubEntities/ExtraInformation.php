<?php

namespace ArrowSphere\PublicApiClient\Orders\Request\SubEntities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

class ExtraInformation extends AbstractEntity
{
    public const COLUMN_PROGRAMS = 'programs';

    /**
     * @var array
     */
    #[Property(isArray: true, required: true)]
    protected array $programs;

    /**
     * @return array
     */
    public function getPrograms(): array
    {
        return $this->programs;
    }
}
