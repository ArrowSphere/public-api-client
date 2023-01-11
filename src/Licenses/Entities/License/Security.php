<?php

namespace ArrowSphere\PublicApiClient\Licenses\Entities\License;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

class Security extends AbstractEntity
{
    public const COLUMN_ACTIVE_FRAUD_EVENTS = 'activeFraudEvents';

    protected const VALIDATION_RULES = [
        self::COLUMN_ACTIVE_FRAUD_EVENTS  => 'numeric|nullable',
    ];

    /**
     * @var int|null
     */
    private $activeFraudEvents;

    /**
     * Security constructor.
     *
     * @param array $data
     *
     * @throws EntityValidationException
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
