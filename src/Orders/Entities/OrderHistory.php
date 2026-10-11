<?php

namespace ArrowSphere\PublicApiClient\Orders\Entities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

class OrderHistory extends AbstractEntity
{
    public const COLUMN_ORDER_ID = 'orderId';

    public const COLUMN_ACTION = 'action';

    public const COLUMN_DESCRIPTION = 'description';

    public const COLUMN_USER = 'user';

    public const COLUMN_DATE_ACTION = 'dateAction';

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_ORDER_ID, required: true)]
    protected string $orderId;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_ACTION)]
    protected string $action = '';

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_DESCRIPTION)]
    protected string $description = '';

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_USER)]
    protected string $user = '';

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_DATE_ACTION)]
    protected string $dateAction = '';

    /**
     * @return string
     */
    public function getOrderId(): string
    {
        return $this->orderId;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getUser(): string
    {
        return $this->user;
    }

    /**
     * @return string
     */
    public function getDateAction(): string
    {
        return $this->dateAction;
    }
}
