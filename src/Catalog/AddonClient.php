<?php

namespace ArrowSphere\PublicApiClient\Catalog;

use ArrowSphere\PublicApiClient\Catalog\Entities\Offer;
use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use Generator;

/**
 * Class AddonClient
 *
 * @deprecated These endpoints shouldn't be called and be replaced by the ones on OfferClient.
 */
class AddonClient extends AbstractCatalogClient
{
    use LegacyOfferConverterTrait;

    /**
     * Provides all offers of given classification, program and serviceRef.
     * Returns the raw data from the API.
     *
     * @param string $classification
     * @param string $program
     * @param string $serviceRef
     * @param string $sku
     *
     * @return string
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     *
     * @deprecated this method should be replaced by OfferClient::postFind()
     */
    public function getAddonsRaw(string $classification, string $program, string $serviceRef, string $sku): string
    {
        $classification = urlencode($classification);
        $program = urlencode($program);
        $serviceRef = urlencode($serviceRef);
        $sku = urlencode($sku);

        $this->path = "/categories/$classification/programs/$program/products/$serviceRef/offers/$sku/addons";

        return $this->get();
    }

    /**
     * Provides all programs of given classification, program and serviceRef.
     * Returns an array (generator) of Offer.
     *
     * @param string $classification
     * @param string $program
     * @param string $serviceRef
     * @param string $sku
     *
     * @return Generator|Offer[]
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     *
     * @deprecated this method should be replaced by OfferClient::postFind()
     */
    public function getAddons(string $classification, string $program, string $serviceRef, string $sku): Generator
    {
        $this->setPerPage(100);
        $currentPage = 1;
        $lastPage = false;

        while (! $lastPage) {
            $this->setPage($currentPage);
            $rawResponse = $this->getAddonsRaw($classification, $program, $serviceRef, $sku);
            $response = $this->decodeResponse($rawResponse);

            if ($response['pagination']['total_page'] <= $currentPage) {
                $lastPage = true;
            }

            $currentPage++;

            foreach ($response['data'] as $data) {
                yield new Offer($this->convertLegacyOfferPayload($data));
            }
        }
    }

    /**
     * Gets a single offer.
     *
     * Returns the raw data from the API.
     *
     * @param string $classification
     * @param string $program
     * @param string $serviceRef
     * @param string $sku
     * @param string $addonSku
     *
     * @return string
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     *
     * @deprecated This method should be replaced by OfferClient::getOfferDetailsRaw()
     */
    public function getAddonRaw(string $classification, string $program, string $serviceRef, string $sku, string $addonSku): string
    {
        $classification = urlencode($classification);
        $program = urlencode($program);
        $serviceRef = urlencode($serviceRef);
        $sku = urlencode($sku);
        $addonSku = urlencode($addonSku);

        $this->path = "/categories/$classification/programs/$program/products/$serviceRef/offers/$sku/addons/$addonSku";

        return $this->get();
    }

    /**
     * Gets a single offer.
     *
     * @param string $classification
     * @param string $program
     * @param string $serviceRef
     * @param string $sku
     * @param string $addonSku
     *
     * @return Offer
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     *
     * @deprecated This method should be replaced by OfferClient::getOfferDetails()
     */
    public function getAddon(string $classification, string $program, string $serviceRef, string $sku, string $addonSku): Offer
    {
        $rawResponse = $this->getAddonRaw($classification, $program, $serviceRef, $sku, $addonSku);
        $response = $this->decodeResponse($rawResponse);

        return new Offer($this->convertLegacyOfferPayload($response['data']));
    }
}
