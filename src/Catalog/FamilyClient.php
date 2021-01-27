<?php

namespace ArrowSphere\PublicApiClient\Catalog;

use ArrowSphere\PublicApiClient\Catalog\Entities\Family;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;
use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use Generator;

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
     *
     * @return string The response from the API.
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function getFamiliesRaw(string $vendorCode): string
    {
        $vendorCode = urlencode($vendorCode);

        $this->path = "/families/$vendorCode";

        return $this->get();
    }

    /**
     * Provides all families of given vendor.
     * Returns an array (generator) of Family.
     *
     * @param string $vendorCode The vendor code.
     *
     * @return Generator|Family[]
     * @throws PublicApiClientException
     * @throws EntityValidationException
     */
    public function getFamilies(string $vendorCode): Generator
    {
        $this->setPerPage(100);
        $currentPage = 1;
        $lastPage = false;

        while (! $lastPage) {
            $this->setPage($currentPage);
            $rawResponse = $this->getFamiliesRaw($vendorCode);
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
     *
     * @return string
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function getFamilyRaw(string $vendorCode, string $reference): string
    {
        $vendorCode = urlencode($vendorCode);
        $reference = urlencode($reference);

        $this->path = "/families/$vendorCode/$reference";

        return $this->get();
    }

    /**
     * Gets a single family.
     *
     * @param string $vendorCode The vendor code
     * @param string $reference The family's reference
     *
     * @return Family
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function getFamily(string $vendorCode, string $reference): Family
    {
        $rawResponse = $this->getFamilyRaw($vendorCode, $reference);
        $response = $this->decodeResponse($rawResponse);

        return new Family($response['data']);
    }
}
