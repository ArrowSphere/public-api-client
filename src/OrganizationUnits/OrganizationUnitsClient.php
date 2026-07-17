<?php

namespace ArrowSphere\PublicApiClient\OrganizationUnits;

use ArrowSphere\PublicApiClient\AbstractClient;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;
use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use ArrowSphere\PublicApiClient\OrganizationUnits\Entities\OrganizationUnit;
use ArrowSphere\PublicApiClient\OrganizationUnits\Entities\OrganizationUnitsResponse;
use Generator;
use GuzzleHttp\Exception\GuzzleException;

class OrganizationUnitsClient extends AbstractClient
{
    /**
     * @var string is The base path of the API
     */
    protected $basePath = '/organizationUnit';

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
        $this->path = '/';

        return $this->get($parameters);
    }

    /**
     * Lists the organization units.
     * Returns an array (Generator) of OrganizationUnit.
     *
     * @param array $parameters
     *
     * @return Generator<OrganizationUnit>
     *
     * @throws EntityValidationException
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function getOrganizationUnits(array $parameters = []): Generator
    {
        $this->setPerPage(100);
        $currentPage = 1;
        $lastPage = false;

        while (! $lastPage) {
            $this->setPage($currentPage);
            $rawResponse = $this->getOrganizationUnitsRaw($parameters);
            $response = $this->decodeResponse($rawResponse);

            if ($response['pagination']['total_page'] <= $currentPage) {
                $lastPage = true;
            }

            $currentPage++;

            foreach ($response['data'] as $data) {
                yield new OrganizationUnit($data);
            }
        }
    }

    /**
     * Get the units that belong to the company per page.
     * Returns an OrganizationUnitsResponse that holds pagination information and the list of organization units from the current page.
     *
     * @param array $parameters Optional parameters to add to the URL
     *
     * @return OrganizationUnitsResponse
     *
     * @throws EntityValidationException
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function getOrganizationUnitsPage(array $parameters = []): OrganizationUnitsResponse
    {
        if (empty($this->perPage)) {
            $this->setPerPage(100);
        }

        $rawResponse = $this->getOrganizationUnitsRaw($parameters);
        $response = $this->decodeResponse($rawResponse);

        return new OrganizationUnitsResponse($response);
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

        $this->path = '/';

        $rawResponse = $this->post($payload, $parameters);

        $response = $this->getResponseData($rawResponse->__toString());

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
        $this->path = '/ouRef/' . urlencode($reference);

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

        $this->path = '/ouRef/' . urlencode($organizationUnit->getOrganizationUnitRef());

        $rawResponse = $this->patch($payload, $parameters);

        $response = $this->getResponseData($rawResponse->__toString());

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
        $this->path = '/ouRef/' . urlencode($reference);

        $rawResponse = $this->get($parameters);

        $response = $this->getResponseData($rawResponse);

        return new OrganizationUnit($response);
    }
}
