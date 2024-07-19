<?php

namespace ArrowSphere\PublicApiClient\Orders\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;

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
    private string $orderId;

    /**
     * @var string Action on the order
     */
    private string $action;

    /**
     * @var string Description of the action
     */
    private string $description;

    /**
     * @var string Name of the user that executed the action
     */
    private string $user;

    /**
     * @var string Date the action was executed
     */
    private string $dateAction;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->orderId = $data[self::COLUMN_ORDER_ID];
        $this->action = $data[self::COLUMN_ACTION] ?? '';
        $this->description = $data[self::COLUMN_DESCRIPTION] ?? '';
        $this->user = $data[self::COLUMN_USER] ?? '';
        $this->dateAction = $data[self::COLUMN_DATE_ACTION] ?? '';
    }

    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_ORDER_ID    => $this->orderId,
            self::COLUMN_ACTION      => $this->action,
            self::COLUMN_DESCRIPTION => $this->description,
            self::COLUMN_USER        => $this->user,
            self::COLUMN_DATE_ACTION => $this->dateAction,
        ];
    }

    public function getOrderId(): string
    {
        return $this->orderId;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getUser(): string
    {
        return $this->user;
    }

    public function getDateAction(): string
    {
        return $this->dateAction;
    }
}
