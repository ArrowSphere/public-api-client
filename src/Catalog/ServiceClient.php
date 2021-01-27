<?php

namespace ArrowSphere\PublicApiClient\Catalog;

use ArrowSphere\PublicApiClient\Catalog\Entities\Service;
use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use Generator;

/**
 * Class ServiceClient
 *
 * @deprecated use FamilyClient instead
 */
class ServiceClient extends AbstractCatalogClient
{
    /**
     * Provides all services of given classification and program.
     * Returns the raw data from the API.
     *
     * @param string $classification The classification of the services (SAAS, IAAS...)
     * @param string $program The program of the services (Microsoft, Bittitan...)
     *
     * @return string The response from the API.
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function getServicesRaw(string $classification, string $program): string
    {
        $classification = urlencode($classification);
        $program = urlencode($program);

        $this->path = "/categories/$classification/programs/$program/products";

        return $this->get();
    }

    /**
     * Provides all services of given classification and program.
     * Returns an array (generator) of Service.
     *
     * @param string $classification
     * @param string $program
     *
     * @return Generator|Service[]
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function getServices(string $classification, string $program): Generator
    {
        $this->setPerPage(100);
        $currentPage = 1;
        $lastPage = false;

        while (! $lastPage) {
            $this->setPage($currentPage);
            $rawResponse = $this->getServicesRaw($classification, $program);
            $response = $this->decodeResponse($rawResponse);

            if ($response['pagination']['total_page'] <= $currentPage) {
                $lastPage = true;
            }

            $currentPage++;

            foreach ($response['data'] as $data) {
                yield new Service($data);
            }
        }
    }

    /**
     * Gets a single service.
     *
     * Returns the raw data from the API.
     *
     * @param string $classification
     * @param string $program
     * @param string $serviceRef
     *
     * @return string
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function getServiceRaw(string $classification, string $program, string $serviceRef): string
    {
        $classification = urlencode($classification);
        $program = urlencode($program);
        $serviceRef = urlencode($serviceRef);

        $this->path = "/categories/$classification/programs/$program/products/$serviceRef";

        return $this->get();
    }

    /**
     * Gets a single service.
     *
     * @param string $classification
     * @param string $program
     * @param string $serviceRef
     *
     * @return Service
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function getService(string $classification, string $program, string $serviceRef): Service
    {
        $rawResponse = $this->getServiceRaw($classification, $program, $serviceRef);
        $response = $this->decodeResponse($rawResponse);

        return new Service($response['data']);
    }
}
