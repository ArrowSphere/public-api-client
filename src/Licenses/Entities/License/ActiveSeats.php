<?php

namespace ArrowSphere\PublicApiClient\Licenses\Entities\License;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

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
    private $lastUpdate;

    /**
     * @var float|null
     */
    private $number;

    /**
     * ActiveSeats constructor.
     *
     * @param array $data
     *
     * @throws EntityValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->lastUpdate = $data[self::COLUMN_LAST_UPDATE];
        $this->number = $data[self::COLUMN_NUMBER];
    }

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

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_LAST_UPDATE => $this->lastUpdate,
            self::COLUMN_NUMBER      => $this->number,
        ];
    }
}
