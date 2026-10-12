<?php

namespace ArrowSphere\PublicApiClient\Licenses\Entities\Offer\PriceBand;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

/**
 * Class ActionFlags
 */
class ActionFlags extends AbstractEntity
{
    public const COLUMN_CAN_BE_CANCELLED = 'canBeCancelled';

    public const COLUMN_CAN_BE_REACTIVATED = 'canBeReactivated';

    public const COLUMN_CAN_BE_SUSPENDED = 'canBeSuspended';

    public const COLUMN_CAN_DECREASE_SEATS = 'canDecreaseSeats';

    public const COLUMN_CAN_INCREASE_SEATS = 'canIncreaseSeats';

    /**
     * @var bool
     */
    #[Property(name: self::COLUMN_CAN_BE_CANCELLED, type: 'bool', required: true)]
    protected bool $canBeCancelled;

    /**
     * @var bool
     */
    #[Property(name: self::COLUMN_CAN_BE_REACTIVATED, type: 'bool', required: true)]
    protected bool $canBeReactivated;

    /**
     * @var bool
     */
    #[Property(name: self::COLUMN_CAN_BE_SUSPENDED, type: 'bool', required: true)]
    protected bool $canBeSuspended;

    /**
     * @var bool
     */
    #[Property(name: self::COLUMN_CAN_DECREASE_SEATS, type: 'bool', required: true)]
    protected bool $canDecreaseSeats;

    /**
     * @var bool
     */
    #[Property(name: self::COLUMN_CAN_INCREASE_SEATS, type: 'bool', required: true)]
    protected bool $canIncreaseSeats;

    /**
     * @return bool
     */
    public function getCanBeCancelled(): bool
    {
        return $this->canBeCancelled;
    }

    /**
     * @return bool
     */
    public function getCanBeReactivated(): bool
    {
        return $this->canBeReactivated;
    }

    /**
     * @return bool
     */
    public function getCanBeSuspended(): bool
    {
        return $this->canBeSuspended;
    }

    /**
     * @return bool
     */
    public function getCanDecreaseSeats(): bool
    {
        return $this->canDecreaseSeats;
    }

    /**
     * @return bool
     */
    public function getCanIncreaseSeats(): bool
    {
        return $this->canIncreaseSeats;
    }
}
