<?php

namespace ArrowSphere\PublicApiClient\Licenses\Entities\License;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

/**
 * Class ActiveSeats
 */
class ActiveSeats extends AbstractEntity
{
    public const COLUMN_LAST_UPDATE = 'lastUpdate';

    public const COLUMN_NUMBER = 'number';

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_LAST_UPDATE, serializeNull: true)]
    protected ?string $lastUpdate = null;

    /**
     * @var float|null
     */
    #[Property(name: self::COLUMN_NUMBER, type: 'float', serializeNull: true)]
    protected ?float $number = null;

    /**
     * @return string|null
     */
    public function getLastUpdate(): ?string
    {
        return $this->lastUpdate;
    }

    /**
     * @return float|null
     */
    public function getNumber(): ?float
    {
        return $this->number;
    }
}
