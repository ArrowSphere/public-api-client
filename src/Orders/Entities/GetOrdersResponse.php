<?php

namespace ArrowSphere\PublicApiClient\Orders\Entities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Exception\EntitiesException;
use ArrowSphere\PublicApiClient\Entities\Pagination;
use ArrowSphere\PublicApiClient\Entities\Property;

class GetOrdersResponse extends AbstractEntity
{
    public const PAGINATION = 'pagination';
    public const ORDERS = 'orders';

    /**
     * @var Order[]
     */
    #[Property(name: self::ORDERS, type: Order::class, isArray: true)]
    protected array $orders = [];

    /**
     * @var Pagination
     */
    #[Property(name: self::PAGINATION, type: Pagination::class)]
    protected Pagination $pagination;

    /**
     * GetOrdersResponse constructor.
     *
     * @param array $data
     *
     * @throws EntitiesException
     */
    public function __construct(array $data)
    {
        // The orders come from the data of the response, the pagination from its root
        parent::__construct([
            self::ORDERS  => $data['data'][self::ORDERS] ?? [],
            self::PAGINATION => $data[self::PAGINATION] ?? [],
        ]);

        // A missing pagination gets an empty one, as an empty array would be considered as missing
        if (! isset($this->pagination)) {
            $this->pagination = new Pagination([]);
        }
    }

    /**
     * @return Order[]
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
