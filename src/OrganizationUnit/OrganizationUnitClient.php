<?php

namespace ArrowSphere\PublicApiClient\OrganizationUnit;

use ArrowSphere\PublicApiClient\AbstractClient;
use ArrowSphere\PublicApiClient\Entities\Exception\EntitiesException;
use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use ArrowSphere\PublicApiClient\OrganizationUnit\Entities\OrganizationUnit;
use Generator;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Class OrganizationUnitClient
 */
class OrganizationUnitClient extends AbstractClient
{
    /**
     * @var string The base path of the Organization Unit API
     */
    protected const ROOT_PATH = '/organizationUnit';

    /**
     * @var string The base path of the API
     */
    protected $basePath = self::ROOT_PATH;

    /**
     * @param array $parameters Optional parameters to add to the URL.
     *                          Supported filters: organizationUnitRef, companyRef, name.
     *                          Supported sorting: sort_by, order_by.
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
     * @throws EntitiesException
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
            /** @var array{data: array[], pagination: array{total_page: int}} $response */
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
     * @param string $name
     * @param array $parameters Optional parameters to add to the URL
     *
     * @return string
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function createOrganizationUnitRaw(string $name, array $parameters = []): string
    {
        $this->path = '/';

        return $this->post([OrganizationUnit::COLUMN_NAME => $name], $parameters)->__toString();
    }

    /**
     * Create a new organization unit for the company.
     *
     * @param string $name
     * @param array $parameters Optional parameters to add to the URL
     *
     * @return OrganizationUnit
     *
     * @throws EntitiesException
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function createOrganizationUnit(string $name, array $parameters = []): OrganizationUnit
    {
        $rawResponse = $this->createOrganizationUnitRaw($name, $parameters);

        return new OrganizationUnit($this->getResponseData($rawResponse));
    }

    /**
     * @param string $reference
     * @param array $parameters Optional parameters to add to the URL
     *
     * @return string
     *
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function getOrganizationUnitRaw(string $reference, array $parameters = []): string
    {
        $this->path = '/ouRef/' . urlencode($reference);

        return $this->get($parameters);
    }

    /**
     * Get information from a specific organization unit.
     *
     * @param string $reference
     * @param bool $withDetails Whether additional information about related users and end customers should be retrieved
     * @param array $parameters Optional parameters to add to the URL
     *
     * @return OrganizationUnit
     *
     * @throws EntitiesException
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function getOrganizationUnit(string $reference, bool $withDetails = false, array $parameters = []): OrganizationUnit
    {
        if ($withDetails) {
            $parameters['withDetails'] = 'true';
        }

        $rawResponse = $this->getOrganizationUnitRaw($reference, $parameters);

        return new OrganizationUnit($this->getResponseData($rawResponse));
    }

    /**
     * @param string $reference
     * @param array $parameters Optional parameters to add to the URL
     *
     * @return string
     *
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function deleteOrganizationUnitRaw(string $reference, array $parameters = []): string
    {
        $this->path = '/ouRef/' . urlencode($reference);

        return $this->delete($parameters);
    }

    /**
     * Delete an organization unit.
     *
     * @param string $reference
     * @param array $parameters Optional parameters to add to the URL
     *
     * @return string
     *
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function deleteOrganizationUnit(string $reference, array $parameters = []): string
    {
        return $this->deleteOrganizationUnitRaw($reference, $parameters);
    }

    /**
     * @param string $reference
     * @param string $name
     * @param array $parameters Optional parameters to add to the URL
     *
     * @return string
     *
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function updateOrganizationUnitRaw(string $reference, string $name, array $parameters = []): string
    {
        $this->path = '/ouRef/' . urlencode($reference);

        return $this->patch([OrganizationUnit::COLUMN_NAME => $name], $parameters)->__toString();
    }

    /**
     * Update an organization unit.
     *
     * @param string $reference
     * @param string $name
     * @param array $parameters Optional parameters to add to the URL
     *
     * @return OrganizationUnit
     *
     * @throws EntitiesException
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function updateOrganizationUnit(string $reference, string $name, array $parameters = []): OrganizationUnit
    {
        $rawResponse = $this->updateOrganizationUnitRaw($reference, $name, $parameters);

        return new OrganizationUnit($this->getResponseData($rawResponse));
    }
}
