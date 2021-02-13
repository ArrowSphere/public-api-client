<?php

namespace ArrowSphere\PublicApiClient\Catalog;

use ArrowSphere\PublicApiClient\Catalog\Entities\FindResult;
use ArrowSphere\PublicApiClient\Catalog\Entities\Offer;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;
use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use Generator;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Class OfferClient
 */
class OfferClient extends AbstractCatalogClient
{
    use LegacyOfferConverterTrait;

    /**
     * @var string The path of the Details endpoint
     */
    private const DETAILS_PATH = '/details';

    /**
     * @var string The path of the Find endpoint
     */
    private const FIND_PATH = '/find';

    /**
     * @var string The key for keywords search query parameter
     */
    public const DATA_KEYWORDS = 'keywords';

    /**
     * @var string The key for filers search query parameter
     */
    public const DATA_FILTERS = 'filters';

    /**
     * @var string The key for sort search query parameter
     */
    public const DATA_SORT = 'sort';

    /**
     * @var string The key for highlight search query parameter
     */
    public const DATA_HIGHLIGHT = 'highlight';

    /**
     * @var string The key for topOffers search query parameter
     */
    public const DATA_TOP_OFFERS = 'topOffers';

    /**
     * @var string Use this constant to sort in ascending direction
     */
    public const SORT_ASCENDING = 'asc';

    /**
     * @var string Use this constant to sort in descending direction
     */
    public const SORT_DESCENDING = 'desc';

    /**
     * Provides all the details of a given product, as a raw string output.
     *
     * @param string $classification The classification of the offer (SAAS, IAAS...)
     * @param string $vendorCode The vendor code of the offer (microsoft, bittitan...)
     * @param string $sku The sku of the offer
     * @param array $parameters The parameters to add to the URL
     *
     * @return string The response
     *
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function getOfferDetailsRaw(string $classification, string $vendorCode, string $sku, array $parameters = []): string
    {
        $classification = urlencode($classification);
        $vendorCode = urlencode($vendorCode);
        $sku = urlencode($sku);

        $this->path = self::DETAILS_PATH . "/$classification/$vendorCode/$sku";

        return $this->get($parameters);
    }

    /**
     * Returns a single offer.
     *
     * @param string $classification
     * @param string $vendorCode
     * @param string $sku
     * @param array $parameters
     *
     * @return Offer
     *
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function getOfferDetails(string $classification, string $vendorCode, string $sku, array $parameters = []): Offer
    {
        $rawResponse = $this->getOfferDetailsRaw($classification, $vendorCode, $sku, $parameters);
        $response = $this->decodeResponse($rawResponse);

        return new Offer($response);
    }

    /**
     * Performs a search in the catalog and returns the results as a string.
     *
     * Each offer is provided with a restricted list of properties.
     * The postData is supposed to contain the following keys:
     * - DATA_KEYWORDS: a string to be searched in all the fields. Supports inexact matches (i.e. Ofice for Office)
     * - DATA_FILTERS: an array of strings containing exact matches for individual fields (field name as key and field value as value)
     * - DATA_SORT: an array of strings containing the order in which sort the data (field name as key and a SORT_* const of this class for the sort direction)
     * - DATA_HIGHLIGHT: a boolean value, search results will contain a field giving highlights if set to true (defaults to false)
     * - DATA_TOP_OFFERS: search results will provide top offers if set to true (defaults to false)
     *
     * Note that the field names must be used with the COLUMN_* consts from the Offer entity class.
     *
     * @param array $postData The data to send to the payload
     * @param array $parameters Parameters to append to the query string
     *
     * @return string The response
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function findRaw(array $postData, array $parameters = []): string
    {
        $this->path = self::FIND_PATH;

        if (isset($postData[self::DATA_FILTERS])) {
            $postData[self::DATA_FILTERS] = array_map(static function ($row) {
                return is_array($row) ? array_values($row) : $row;
            }, $postData[self::DATA_FILTERS]);
        }

        return $this->post($postData, $parameters);
    }

    /**
     * Performs a search in the catalog and returns the results as a string.
     *
     * Each offer is provided with a restricted list of properties.
     * The postData is supposed to contain the following keys:
     * - DATA_KEYWORDS: a string to be searched in all the fields. Supports inexact matches (i.e. Ofice for Office)
     * - DATA_FILTERS: an array of strings containing exact matches for individual fields (field name as key and field value as value)
     * - DATA_SORT: an array of strings containing the order in which sort the data (field name as key and a SORT_* const of this class for the sort direction)
     * - DATA_HIGHLIGHT: a boolean value, search results will contain a field giving highlights if set to true (defaults to false)
     * - DATA_TOP_OFFERS: search results will provide top offers if set to true (defaults to false)
     *
     * @param array $postData
     * @param int $perPage
     * @param int $page
     * @param array $parameters
     *
     * @return FindResult
     *
     * @throws EntityValidationException
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function find(array $postData, int $perPage = 100, int $page = 1, array $parameters = []): FindResult
    {
        $this->setPerPage($perPage);
        $this->setPage($page);

        $rawResponse = $this->findRaw($postData, $parameters);
        $response = $this->decodeResponse($rawResponse);

        return new FindResult($response, $this, $postData, $parameters);
    }

    /**
     * Provides all offers of given classification, program and serviceRef.
     * Returns the raw data from the API.
     *
     * @param string $classification
     * @param string $program
     * @param string $serviceRef
     * @param array $parameters Optional parameters to add to the URL
     *
     * @return string
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws GuzzleException
     *
     * @deprecated this method should be replaced by postFind()
     */
    public function getOffersRaw(string $classification, string $program, string $serviceRef, array $parameters = []): string
    {
        $classification = urlencode($classification);
        $program = urlencode($program);
        $serviceRef = urlencode($serviceRef);

        $this->path = "/categories/$classification/programs/$program/products/$serviceRef/offers";

        return $this->get($parameters);
    }

    /**
     * Provides all programs of given classification, program and serviceRef.
     * Returns an array (generator) of Offer.
     *
     * @param string $classification
     * @param string $program
     * @param string $serviceRef
     * @param array $parameters Optional parameters to add to the URL
     *
     * @return Generator|Offer[]
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws GuzzleException
     *
     * @deprecated this method should be replaced by postFind()
     */
    public function getOffers(string $classification, string $program, string $serviceRef, array $parameters = []): Generator
    {
        $this->setPerPage(100);
        $currentPage = 1;
        $lastPage = false;

        while (! $lastPage) {
            $this->setPage($currentPage);

            $rawResponse = $this->getOffersRaw($classification, $program, $serviceRef, $parameters);
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
     * @param array $parameters Optional parameters to add to the URL
     *
     * @return string
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws GuzzleException
     *
     * @deprecated This method should be replaced by getOfferDetailsRaw()
     */
    public function getOfferRaw(string $classification, string $program, string $serviceRef, string $sku, array $parameters = []): string
    {
        $classification = urlencode($classification);
        $program = urlencode($program);
        $serviceRef = urlencode($serviceRef);
        $sku = urlencode($sku);

        $this->path = "/categories/$classification/programs/$program/products/$serviceRef/offers/$sku";

        return $this->get($parameters);
    }

    /**
     * Gets a single offer.
     *
     * @param string $classification
     * @param string $program
     * @param string $serviceRef
     * @param string $sku
     * @param array $parameters Optional parameters to add to the URL
     *
     * @return Offer
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws GuzzleException
     *
     * @deprecated This method should be replaced by getOfferDetails()
     */
    public function getOffer(string $classification, string $program, string $serviceRef, string $sku, array $parameters = []): Offer
    {
        $rawResponse = $this->getOfferRaw($classification, $program, $serviceRef, $sku, $parameters);
        $response = $this->decodeResponse($rawResponse);

        return new Offer($this->convertLegacyOfferPayload($response['data']));
    }
}
