<?php

namespace ArrowSphere\PublicApiClient\Partners;

use ArrowSphere\PublicApiClient\AbstractClient;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;
use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use ArrowSphere\PublicApiClient\Partners\Entities\OrganizationUnit;
use Generator;
use GuzzleHttp\Exception\GuzzleException;

class PartnersClient extends AbstractClient
{
    /**
     * @var string The base path of the Customers API
     */
    protected const ROOT_PATH = '/partners';

    /*
     * @var string The base path of the API
     */
    protected $basePath = self::ROOT_PATH;

    /**
     * @param array $parameters Optional parameters to add to the URL
     *
     * @return string
     *
     * @throws PublicApiClientException
     * @throws NotFoundException
     * @throws GuzzleException
     */
    public function getOrganizationUnitsRaw(array $parameters = []): string
    {
        $this->path = '/organizationUnits';

        return $this->get($parameters);
    }

    /**
     * List all units that belong to the company.
     * Returns an array (generator) of OrganizationUnit.
     *
     * @param array $parameters Optional parameters to add to the URL
     *
     * @return Generator|OrganizationUnit[]
     *
     * @throws EntityValidationException
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function getOrganizationUnitList(array $parameters = []): Generator
    {
        $rawResponse = $this->getOrganizationUnitsRaw($parameters);
        $response = $this->getResponseData($rawResponse);

        foreach ($response as $data) {
            yield new OrganizationUnit($data);
        }
    }

    /**
     * Create a new organization unit for the company and returns its newly created reference.
     *
     * @param OrganizationUnit $organizationUnit
     * @param array $parameters Optional parameters to add to the URL
     *
     * @return OrganizationUnit
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function createOrganizationUnit(OrganizationUnit $organizationUnit, array $parameters = []): OrganizationUnit
    {
        $payload = $organizationUnit->jsonSerialize();
        unset(
            $payload[OrganizationUnit::COLUMN_REFERENCE],
        );

        $this->path = '/organizationUnits';

        $rawResponse = $this->post($payload, $parameters);

        $response = $this->getResponseData($rawResponse);

        return new OrganizationUnit($response);
    }

    /**
     * @param string $reference
     * @param array $parameters
     *
     * @return string
     *
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function deleteOrganizationUnit(string $reference, array $parameters = []): string
    {
        $this->path = '/organizationUnits/' . urlencode($reference);

        return $this->delete($parameters);
    }

    /**
     * @param OrganizationUnit $organizationUnit
     * @param array $parameters
     *
     * @return OrganizationUnit
     *
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function updateOrganizationUnit(OrganizationUnit $organizationUnit, array $parameters = []): OrganizationUnit
    {
        $payload = $organizationUnit->jsonSerialize();

        $this->path = '/organizationUnits/' . urlencode($organizationUnit->getOrganizationUnitRef());

        $rawResponse = $this->patch($payload, $parameters);

        $response = $this->getResponseData($rawResponse);

        return new OrganizationUnit($response);
    }

    /**
     * List all units that belong to the company.
     * Returns an array (generator) of OrganizationUnit.
     *
     * @param string $reference
     * @param array $parameters Optional parameters to add to the URL
     *
     * @return OrganizationUnit
     *
     * @throws EntityValidationException
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function getOrganizationUnit(string $reference, array $parameters = []): OrganizationUnit
    {
        $this->path = '/organizationUnits/' . urlencode($reference);

        $rawResponse = $this->get($parameters);

        $response = $this->getResponseData($rawResponse);

        return new OrganizationUnit($response);
    }
}
