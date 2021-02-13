<?php

namespace ArrowSphere\PublicApiClient\Licenses\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use ArrowSphere\PublicApiClient\Licenses\LicensesClient;
use Generator;

/**
 * Class FindResult
 */
class FindResult extends AbstractEntity
{
    /**
     * @var LicenseFindResult[]
     */
    private $licenses;

    /**
     * @var FilterFindResult[]
     */
    private $filters;

    /**
     * @var LicensesClient
     */
    private $client;

    /**
     * @var array
     */
    private $postData;

    /**
     * @var array
     */
    private $parameters;

    /**
     * @var int
     */
    private $currentPage;

    /**
     * @var int
     */
    private $totalPage;

    /**
     * @var int
     */
    private $nbResults;

    /**
     * FindResult constructor.
     *
     * @param array $data
     * @param LicensesClient $client
     * @param array $postData
     * @param array $parameters
     *
     * @throws EntityValidationException
     */
    public function __construct(array $data, LicensesClient $client, array $postData, array $parameters)
    {
        parent::__construct($data);

        $this->client = $client;
        $this->postData = $postData;
        $this->parameters = $parameters;

        $this->currentPage = $data['pagination']['currentPage'];
        $this->totalPage = $data['pagination']['totalPage'];
        $this->nbResults = $data['pagination']['total'];

        $this->licenses = array_map(static function (array $offer) {
            return new LicenseFindResult($offer);
        }, $data['licenses']);

        $this->filters = array_map(static function (array $filter) {
            return new FilterFindResult($filter);
        }, $data['filters']);
    }

    /**
     * @return Generator|LicenseFindResult[]
     */
    public function getLicensesForCurrentPage(): Generator
    {
        yield from $this->licenses;
    }

    /**
     * @return Generator|LicenseFindResult[]
     *
     * @throws EntityValidationException
     * @throws PublicApiClientException
     */
    public function getLicenses(): Generator
    {
        // First yield the offers we already got in the response from the first page
        yield from $this->getLicensesForCurrentPage();

        // Then parse the other pages... if there are more
        $currentPage = $this->currentPage + 1;
        $lastPage = $this->totalPage <= $currentPage;

        while (! $lastPage) {
            $this->client->setPage($currentPage);

            $rawResponse = $this->client->findRaw($this->postData, $this->parameters);
            $response = $this->client->decodeResponse($rawResponse);

            if ($response['pagination']['totalPage'] <= $currentPage) {
                $lastPage = true;
            }

            $currentPage++;

            foreach ($response['licenses'] as $data) {
                yield new LicenseFindResult($data);
            }
        }
    }

    /**
     * @return FilterFindResult[]
     */
    public function getFilters(): array
    {
        return $this->filters;
    }

    /**
     * @return int
     */
    public function getNbResults(): int
    {
        return $this->nbResults;
    }

    /**
     * @return int
     */
    public function getTotalPages(): int
    {
        return $this->totalPage;
    }

    /**
     * @return array
     *
     * @throws EntityValidationException
     * @throws PublicApiClientException
     */
    public function jsonSerialize()
    {
        return [
            'licenses'  => $this->getLicenses(),
            'filters'   => $this->getFilters(),
            'totalPage' => $this->getTotalPages(),
            'nbResults' => $this->getNbResults(),
        ];
    }
}
