<?php

namespace ArrowSphere\PublicApiClient\Catalog;

use ArrowSphere\PublicApiClient\Catalog\Entities\Family;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;
use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use Generator;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Class FamilyClient
 */
class FamilyClient extends AbstractCatalogClient
{
    /**
     * Provides all services of given classification and program.
     * Returns the raw data from the API.
     *
     * @param string $vendorCode The program of the services (Microsoft, Bittitan...)
     * @param array $parameters Optional parameters to add to the URL
     *
     * @return string The response from the API.
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function getFamiliesRaw(string $vendorCode, array $parameters = []): string
    {
        $vendorCode = urlencode($vendorCode);

        $this->path = "/families/$vendorCode";

        return $this->get($parameters);
    }

    /**
     * Provides all families of given vendor.
     * Returns an array (generator) of Family.
     *
     * @param string $vendorCode The vendor code.
     * @param array $parameters Optional parameters to add to the URL
     *
     * @return Generator|Family[]
     *
     * @throws EntityValidationException
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function getFamilies(string $vendorCode, array $parameters = []): Generator
    {
        $this->setPerPage(100);
        $currentPage = 1;
        $lastPage = false;

        while (! $lastPage) {
            $this->setPage($currentPage);
            $rawResponse = $this->getFamiliesRaw($vendorCode, $parameters);
            $response = $this->decodeResponse($rawResponse);

            if ($response['pagination']['total_page'] <= $currentPage) {
                $lastPage = true;
            }

            $currentPage++;

            foreach ($response['data'] as $data) {
                yield new Family($data);
            }
        }
    }

    /**
     * Gets a single family.
     *
     * Returns the raw data from the API.
     *
     * @param string $vendorCode The vendor code
     * @param string $reference The family's reference
     * @param array $parameters Optional parameters to add to the URL
     *
     * @return string
     *
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function getFamilyRaw(string $vendorCode, string $reference, array $parameters = []): string
    {
        $vendorCode = urlencode($vendorCode);
        $reference = urlencode($reference);

        $this->path = "/families/$vendorCode/$reference";

        return $this->get($parameters);
    }

    /**
     * Gets a single family.
     *
     * @param string $vendorCode The vendor code
     * @param string $reference The family's reference
     * @param array $parameters Optional parameters to add to the URL
     *
     * @return Family
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function getFamily(string $vendorCode, string $reference, array $parameters = []): Family
    {
        $rawResponse = $this->getFamilyRaw($vendorCode, $reference, $parameters);
        $response = $this->decodeResponse($rawResponse);

        return new Family($response['data']);
    }
}
