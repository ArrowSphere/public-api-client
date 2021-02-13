<?php

namespace ArrowSphere\PublicApiClient\Catalog;

use ArrowSphere\PublicApiClient\AbstractClient;
use ArrowSphere\PublicApiClient\Entities\Service;
use Generator;

/**
 * Class CatalogClient for interacting with the Catalog endpoints
 *
 * @deprecated use OfferClient, ServiceClient etc directly
 */
class CatalogClient extends AbstractClient
{
    /**
     * @var string The base path of the Catalog API
     */
    private const ROOT_PATH = '/catalog';

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
    private const KEYWORDS = 'keywords';

    /**
     * @var string The key for filers search query parameter
     */
    private const FILTERS = 'filters';

    /**
     * @var string The key for sort search query parameter
     */
    private const SORT = 'sort';

    /**
     * @var string The key for highlight search query parameter
     */
    private const HIGHLIGHT = 'highlight';

    /**
     * @var string The key for topOffers search query parameter
     */
    private const TOP_OFFERS = 'topOffers';

    /**
     * @var string The base path of the API
     */
    protected $basePath = self::ROOT_PATH;

    /**
     * @var string The search keywords
     */
    private $keywords = '';

    /**
     * @var array the parameters that define how the results will be filtered
     */
    private $filters = [];

    /**
     * @var array The parameters that define the sorting of the search results
     */
    private $sort = [];

    /**
     * @var bool Search results will contain a field giving highlights if set to true
     */
    private $highlight = false;

    /**
     * @var bool Search result will provide top offers if set to true
     */
    private $topOffers = false;

    /**
     * Provides all the details of a given product
     *
     * @param string $type The type of the product (SAAS, IAAS...)
     * @param string $vendor The vendor of the product (Microsoft, Bittitan...)
     * @param string $sku The sku of the product
     * @param array $parameters The parameters to add to the URL
     *
     * @return string The response
     */
    public function getDetails(string $type, string $vendor, string $sku, array $parameters = []): string
    {
        $this->path = self::DETAILS_PATH . "/$type/$vendor/$sku";

        return $this->get($parameters);
    }

    /**
     * Provides all services of given classification and program
     *
     * @param string $classification The classification of the services (SAAS, IAAS...)
     * @param string $program The program of the services (Microsoft, Bittitan...)
     *
     * @return string The response
     */
    public function getServices(string $classification, string $program): string
    {
        $this->path = "/categories/$classification/programs/$program/products";

        return $this->get();
    }

    /**
     * Provides all services Generator of given classification and program
     *
     * @param string $classification
     * @param string $program
     *
     * @return Generator|Service[]
     */
    public function getAllServices(string $classification, string $program): Generator
    {
        $this->setPerPage(100);
        $currentPage = 1;
        $lastPage = false;

        while (! $lastPage) {
            $this->setPage($currentPage);
            $publicApiResponses = json_decode($this->getServices($classification, $program), true);

            if ($publicApiResponses['pagination']['total_page'] <= $currentPage) {
                $lastPage = true;
            }

            $currentPage++;

            foreach ($publicApiResponses['data'] as $data) {
                yield new Service($data);
            }
        }
    }

    /**
     * Provides a list of products as search result
     * Each product is provided with a restricted list of properties
     *
     * @return string The response
     */
    public function postFind(): string
    {
        $this->path = self::FIND_PATH;

        return $this->post([
            self::KEYWORDS   => $this->keywords,
            self::FILTERS    => $this->filters,
            self::SORT       => $this->sort,
            self::HIGHLIGHT  => $this->highlight,
            self::TOP_OFFERS => $this->topOffers,
        ]);
    }

    /**
     * Sets the keywords
     *
     * @param string $keywords
     */
    public function setKeywords(string $keywords): void
    {
        $this->keywords = $keywords;
    }

    /**
     * Sets the filters
     *
     * @param array $filters
     */
    public function setFilters(array $filters): void
    {
        $this->filters = $filters;
    }

    /**
     * Sets the sort rules
     *
     * @param array $sort
     */
    public function setSort(array $sort): void
    {
        $this->sort = $sort;
    }

    /**
     * Sets the highlight mode
     *
     * @param bool $highlight
     */
    public function setHighlight(bool $highlight): void
    {
        $this->highlight = $highlight;
    }

    /**
     * Sets the top offers mode
     *
     * @param bool $topOffers
     */
    public function setTopOffers(bool $topOffers): void
    {
        $this->topOffers = $topOffers;
    }
}
