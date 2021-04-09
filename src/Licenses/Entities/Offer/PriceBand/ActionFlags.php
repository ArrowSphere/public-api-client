<?php

namespace ArrowSphere\PublicApiClient\Licenses\Entities\Offer\PriceBand;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

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

    protected const VALIDATION_RULES = [
        self::COLUMN_CAN_BE_CANCELLED   => 'required|boolean',
        self::COLUMN_CAN_BE_REACTIVATED => 'required|boolean',
        self::COLUMN_CAN_BE_SUSPENDED   => 'required|boolean',
        self::COLUMN_CAN_DECREASE_SEATS => 'required|boolean',
        self::COLUMN_CAN_INCREASE_SEATS => 'required|boolean',
    ];

    /**
     * @var bool
     */
    private $canBeCancelled;

    /**
     * @var bool
     */
    private $canBeReactivated;

    /**
     * @var bool
     */
    private $canBeSuspended;

    /**
     * @var bool
     */
    private $canDecreaseSeats;

    /**
     * @var bool
     */
    private $canIncreaseSeats;

    /**
     * ActionFlags constructor.
     *
     * @param array $data
     *
     * @throws EntityValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->canBeCancelled = $data[self::COLUMN_CAN_BE_CANCELLED];
        $this->canBeReactivated = $data[self::COLUMN_CAN_BE_REACTIVATED];
        $this->canBeSuspended = $data[self::COLUMN_CAN_BE_SUSPENDED];
        $this->canDecreaseSeats = $data[self::COLUMN_CAN_DECREASE_SEATS];
        $this->canIncreaseSeats = $data[self::COLUMN_CAN_INCREASE_SEATS];
    }

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

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'canBeCancelled'   => $this->canBeCancelled,
            'canBeReactivated' => $this->canBeReactivated,
            'canBeSuspended'   => $this->canBeSuspended,
            'canDecreaseSeats' => $this->canDecreaseSeats,
            'canIncreaseSeats' => $this->canIncreaseSeats,
        ];
    }
}
