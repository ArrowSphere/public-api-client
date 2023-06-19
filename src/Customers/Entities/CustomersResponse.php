<?php

namespace ArrowSphere\PublicApiClient\Customers\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Pagination;

class CustomersResponse extends AbstractEntity
{
    public const CUSTOMERS = 'customers';
    public const PAGINATION = 'pagination';

    /**
     * @var Customer[]
     */
    private $customers;

    /**
     * @var Pagination
     */
    private $pagination;

    public function __construct(array $data)
    {
        parent::__construct($data['data']);

        $this->customers = array_map(
            static function (array $customer) {
                return new Customer($customer);
            },
            $data['data'][self::CUSTOMERS] ?? []
        );
        $this->pagination = new Pagination($data[self::PAGINATION] ?? []);
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            self::CUSTOMERS => $this->customers,
            self::PAGINATION => $this->pagination->jsonSerialize(),
        ];
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
