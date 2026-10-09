<?php

namespace ArrowSphere\PublicApiClient\Licenses\Entities\License;

use ArrowSphere\PublicApiClient\AbstractEntity;

class Security extends AbstractEntity
{
    public const COLUMN_ACTIVE_FRAUD_EVENTS = 'activeFraudEvents';

    /**
     * @var int|null
     */
    private $activeFraudEvents;

    /**
     * Security constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->activeFraudEvents = $data[self::COLUMN_ACTIVE_FRAUD_EVENTS] ?? null;
    }

    /**
     * @return int|null
     */
    public function getActiveFraudEvents(): ?int
    {
        return $this->activeFraudEvents;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_ACTIVE_FRAUD_EVENTS => $this->activeFraudEvents,
        ];
    }
}
