<?php

namespace ArrowSphere\PublicApiClient\Catalog\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Catalog\OfferClient;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use Generator;

/**
 * Class FindResult
 */
class FindResult extends AbstractEntity
{
    /**
     * @var OfferFindResult[]
     */
    private $offers;

    /**
     * @var FilterFindResult[]
     */
    private $filters;

    /**
     * @var OfferClient
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
     * @var OfferFindResult[]
     */
    private $topOffers;

    /**
     * FindResult constructor.
     *
     * @param array $data
     * @param OfferClient $client
     * @param array $postData
     * @param array $parameters
     *
     * @throws EntityValidationException
     */
    public function __construct(array $data, OfferClient $client, array $postData, array $parameters)
    {
        parent::__construct($data);

        $this->client = $client;
        $this->postData = $postData;
        $this->parameters = $parameters;

        $this->currentPage = $data['pagination']['current_page'];
        $this->totalPage = $data['pagination']['total_page'];
        $this->nbResults = $data['pagination']['total'];

        $this->offers = array_map(static function (array $offer) {
            return new OfferFindResult($offer);
        }, $data['products']);

        $this->filters = array_map(static function (array $filter) {
            return new FilterFindResult($filter);
        }, $data['filters']);

        $this->topOffers = array_map(static function (array $offer) {
            return new OfferFindResult($offer);
        }, $data['topOffers'] ?? []);
    }

    /**
     * @return Generator|OfferFindResult[]
     */
    public function getOffersForCurrentPage(): Generator
    {
        yield from $this->offers;
    }

    /**
     * @return Generator|OfferFindResult[]
     *
     * @throws EntityValidationException
     * @throws PublicApiClientException
     */
    public function getOffers(): Generator
    {
        // First yield the offers we already got in the response from the first page
        yield from $this->getOffersForCurrentPage();

        // Then parse the other pages... if there are more
        $currentPage = $this->currentPage + 1;
        $lastPage = $this->totalPage <= $currentPage;

        while (! $lastPage) {
            $this->client->setPage($currentPage);

            $rawResponse = $this->client->findRaw($this->postData, $this->parameters);
            $response = $this->client->decodeResponse($rawResponse);

            if ($response['pagination']['total_page'] <= $currentPage) {
                $lastPage = true;
            }

            $currentPage++;

            foreach ($response['products'] as $data) {
                yield new OfferFindResult($data);
            }
        }
    }

    /**
     * @return OfferFindResult[]
     */
    public function getTopOffers(): array
    {
        return $this->topOffers;
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

    public function jsonSerialize()
    {
        return [
            'offers'    => $this->getOffers(),
            'filters'   => $this->getFilters(),
            'totalPage' => $this->getTotalPages(),
            'nbResults' => $this->getNbResults(),
            'topOffer'  => $this->getTopOffers()
        ];
    }
}
