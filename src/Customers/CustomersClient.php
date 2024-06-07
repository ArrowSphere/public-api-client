<?php

namespace ArrowSphere\PublicApiClient\Customers;

use ArrowSphere\PublicApiClient\AbstractClient;
use ArrowSphere\PublicApiClient\Customers\Entities\Customer;
use ArrowSphere\PublicApiClient\Customers\Entities\CustomersResponse;
use ArrowSphere\PublicApiClient\Customers\Entities\Invitation;
use ArrowSphere\PublicApiClient\Entities\Pagination;
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
     * @param array $parameters Optional parameters to add to the URL
     *
     * @return string
     *
     * @throws PublicApiClientException
     * @throws NotFoundException
     * @throws GuzzleException
     */
    public function getCustomersRaw(array $parameters = []): string
    {
        $this->path = '/customers';

        return $this->get($parameters);
    }

    /**
     * Lists the customers.
     * Returns an array (generator) of Customer.
     *
     * @param array $parameters Optional parameters to add to the URL
     *
     * @return Generator|Customer[]
     *
     * @throws EntityValidationException
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function getCustomers(array $parameters = []): Generator
    {
        $this->setPerPage(100);
        $currentPage = 1;
        $lastPage = false;

        while (! $lastPage) {
            $this->setPage($currentPage);
            $rawResponse = $this->getCustomersRaw($parameters);
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
     * Get the customers per page.
     * Returns a CustomersResponse that holds pagination information and the list of customers from the current page.
     *
     * @param array $parameters Optional parameters to add to the URL
     *
     * @return CustomersResponse
     *
     * @throws EntityValidationException
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function getCustomersPage(array $parameters = []): CustomersResponse
    {
        if (! isset($this->perPage)) {
            $this->setPerPage(100);
        }

        $rawResponse = $this->getCustomersRaw($parameters);
        $response = $this->decodeResponse($rawResponse);

        return new CustomersResponse($response);
    }

    /**
     * Creates a customer and returns its newly created reference.
     *
     * @param array $parameters Optional parameters to add to the URL
     * @param Customer $customer
     *
     * @return string
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function createCustomer(Customer $customer, array $parameters = []): string
    {
        $payload = $customer->jsonSerialize();
        unset(
            $payload[Customer::COLUMN_DELETED_AT],
            $payload[Customer::COLUMN_REFERENCE]
        );

        $this->path = '/customers';

        $rawResponse = $this->post($payload, $parameters);

        $response = $this->decodeResponse($rawResponse);

        return $response['data']['reference'];
    }

    /**
     * Update and return an existing customer.
     *
     * @param Customer $customer
     * @param array $parameters
     *
     * @return Customer
     *
     * @throws EntityValidationException
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function updateCustomer(Customer $customer, array $parameters = []): Customer
    {
        $payload = $customer->jsonSerialize();
        unset(
            $payload[Customer::COLUMN_DELETED_AT],
            $payload[Customer::COLUMN_REFERENCE]
        );

        $this->path = '/customers/' . urlencode($customer->getReference());

        $rawResponse = $this->patch($payload, $parameters);

        $response = $this->getResponseData($rawResponse);

        return new Customer($response['customers'][0]);
    }

    /**
     * Get a specific customer
     *
     * @param string $customerReference
     * @param array $parameters
     *
     * @return Customer
     *
     * @throws EntityValidationException
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function getCustomer(string $customerReference, array $parameters = []): Customer
    {
        $this->path = '/customers/' . urlencode($customerReference);

        $rawResponse = $this->get($parameters);

        $response = $this->getResponseData($rawResponse);

        return new Customer($response['customers'][0]);
    }

    /**
     * @param string $code
     * @param array $parameters
     *
     * @return string
     *
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function getInvitationRaw(string $code, array $parameters = []): string
    {
        $this->path = sprintf(
            '/customers/invitations/%s',
            $code
        );

        return $this->get($parameters);
    }

    /**
     * @param string $code
     * @param array $parameters
     *
     * @return Invitation
     *
     * @throws EntityValidationException
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function getInvitation(string $code, array $parameters = []): Invitation
    {
        $rawResponse = $this->getInvitationRaw($code, $parameters);

        $response = $this->decodeResponse($rawResponse);

        return new Invitation($response['data']);
    }

    /**
     * @param int $contactId
     * @param string $policy
     * @param array $parameters
     *
     * @return Invitation
     *
     * @throws EntityValidationException
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function createInvitation(int $contactId, string $policy, array $parameters = []): Invitation
    {
        $payload = [
            'contactId' => $contactId,
            'policy' => $policy,
        ];

        $this->path = '/customers/invitations';

        $rawResponse = $this->post($payload, $parameters);

        $response = $this->decodeResponse($rawResponse);

        return new Invitation($response['data']);
    }

    /**
     * @param string $program
     * @param array $parameters
     *
     * @return string
     *
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function postReconciliation(string $program, array $parameters = []): string
    {
        $this->path = '/customers/reconciliation';

        return $this->post(['program' => $program], $parameters);
    }
}
