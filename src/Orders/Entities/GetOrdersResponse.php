<?php

namespace ArrowSphere\PublicApiClient\Orders\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Pagination;

class GetOrdersResponse extends AbstractEntity
{
    public const PAGINATION = 'pagination';
    public const ORDERS = 'orders';

    /**
     * @var \ArrowSphere\PublicApiClient\Orders\Entities\Order[]
     */
    private array $orders;

    /**
     * @var Pagination
     */
    private Pagination $pagination;

    public function __construct(array $data)
    {
        parent::__construct($data['data']);

        $this->orders = array_map(
            static fn (array $order) => new Order($order),
            $data['data'][self::ORDERS] ?? []
        );
        $this->pagination = new Pagination($data[self::PAGINATION] ?? []);
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            self::ORDERS     => array_map(static fn (Order $order) => $order->jsonSerialize(), $this->orders),
            self::PAGINATION => $this->pagination->jsonSerialize(),
        ];
    }

    /**
     * @return \ArrowSphere\PublicApiClient\Orders\Entities\Order[]
     */
    public function getOrders(): array
    {
        return $this->orders;
    }

    /**
     * @return Pagination
     */
    public function getPagination(): Pagination
    {
        return $this->pagination;
    }
}
