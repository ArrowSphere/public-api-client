<?php

namespace ArrowSphere\PublicApiClient\Customers\Entities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Exception\EntitiesException;
use ArrowSphere\PublicApiClient\Entities\Pagination;
use ArrowSphere\PublicApiClient\Entities\Property;

class CustomersResponse extends AbstractEntity
{
    public const CUSTOMERS = 'customers';
    public const PAGINATION = 'pagination';

    /**
     * @var Customer[]
     */
    #[Property(name: self::CUSTOMERS, type: Customer::class, isArray: true)]
    protected array $customers = [];

    /**
     * @var Pagination
     */
    #[Property(name: self::PAGINATION, type: Pagination::class)]
    protected Pagination $pagination;

    /**
     * CustomersResponse constructor.
     *
     * @param array $data
     *
     * @throws EntitiesException
     */
    public function __construct(array $data)
    {
        /** @var array{data?: array{customers?: array}, pagination?: array} $data */
        // The customers come from the data of the response, the pagination from its root
        parent::__construct([
            self::CUSTOMERS  => $data['data'][self::CUSTOMERS] ?? [],
            self::PAGINATION => $data[self::PAGINATION] ?? [],
        ]);

        // A missing pagination gets an empty one, as an empty array would be considered as missing
        if (! isset($this->pagination)) {
            $this->pagination = new Pagination([]);
        }
    }

    /**
     * @return Customer[]
     */
    public function getCustomers(): array
    {
        return $this->customers;
    }

    /**
     * @return Pagination
     */
    public function getPagination(): Pagination
    {
        return $this->pagination;
    }
}
