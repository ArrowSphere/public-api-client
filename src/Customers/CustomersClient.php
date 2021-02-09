<?php

namespace ArrowSphere\PublicApiClient\Customers;

use ArrowSphere\PublicApiClient\AbstractClient;
use ArrowSphere\PublicApiClient\Customers\Entities\Customer;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;
use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use Generator;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Class CustomersClient
 */
class CustomersClient extends AbstractClient
{
    /**
     * @return string
     * @throws PublicApiClientException
     * @throws NotFoundException
     * @throws GuzzleException
     */
    public function getCustomersRaw(): string
    {
        $this->path = '/customers';

        return $this->get();
    }

    /**
     * Lists the customers.
     * Returns an array (generator) of Customer.
     *
     * @return Generator|Customer[]
     * @throws EntityValidationException
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function getCustomers(): Generator
    {
        $this->setPerPage(100);
        $currentPage = 1;
        $lastPage = false;

        while (! $lastPage) {
            $this->setPage($currentPage);
            $rawResponse = $this->getCustomersRaw();
            $response = $this->decodeResponse($rawResponse);

            if ($response['pagination']['total_page'] <= $currentPage) {
                $lastPage = true;
            }

            $currentPage++;

            foreach ($response['data']['customers'] as $data) {
                yield new Customer($data);
            }
        }
    }

    /**
     * Creates a customer and returns its newly created reference.
     *
     * @param Customer $customer
     * @return string
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function createCustomer(Customer $customer): string
    {
        $payload = $customer->jsonSerialize();
        unset(
            $payload[Customer::COLUMN_DELETED_AT],
            $payload[Customer::COLUMN_REFERENCE]
        );

        $this->path = '/customers';

        $rawResponse = $this->post($payload);

        $response = $this->decodeResponse($rawResponse);

        return $response['data']['reference'];
    }
}
