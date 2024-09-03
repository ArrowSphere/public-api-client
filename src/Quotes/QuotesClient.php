<?php

namespace ArrowSphere\PublicApiClient\Quotes;

use ArrowSphere\PublicApiClient\AbstractClient;
use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use ArrowSphere\PublicApiClient\Quotes\Request\CreateQuote;
use ArrowSphere\PublicApiClient\Quotes\Response\CreateQuoteResponse;
use GuzzleHttp\Exception\GuzzleException;

class QuotesClient extends AbstractClient
{
    /**
     * @var string The base path of the API
     */
    protected $basePath = '/quotes';

    /**
     * @param CreateQuote $quote
     *
     * @return CreateQuoteResponse
     *
     * @throws NotFoundException
     * @throws GuzzleException
     * @throws PublicApiClientException
     */
    public function create(CreateQuote $quote): CreateQuoteResponse
    {
        $this->path = '';
        $response = $this->post($quote->jsonSerialize());

        return new CreateQuoteResponse($this->getResponseData($response->__toString()));
    }
}
