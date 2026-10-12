<?php

namespace ArrowSphere\PublicApiClient\Licenses\Entities\License;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

class Security extends AbstractEntity
{
    public const COLUMN_ACTIVE_FRAUD_EVENTS = 'activeFraudEvents';

    /**
     * @var int|null
     */
    #[Property(name: self::COLUMN_ACTIVE_FRAUD_EVENTS, type: 'int', serializeNull: true)]
    protected ?int $activeFraudEvents = null;

    /**
     * @return int|null
     */
    public function getActiveFraudEvents(): ?int
    {
        return $this->activeFraudEvents;
    }
}
