<?php

namespace ArrowSphere\PublicApiClient;

use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * Class AbstractClient for interacting with the Public API endpoints
 */
abstract class AbstractClient
{
    /**
     * @var string The xSP api key for authentication on the Public API endpoints
     */
    private const API_KEY = 'apiKey';

    /**
     * @var string The page keyword for pagination
     */
    protected const PAGE = 'page';

    /**
     * @var string The keyword for number of results per page for pagination
     */
    protected const PER_PAGE = 'per_page';

    /**
     * @var string The base path of the API
     */
    protected $basePath = '';

    /**
     * @var string The path of the endpoint
     */
    protected $path = '';

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var string The url of the request
     */
    protected $url;

    /**
     * @var string The API key
     */
    protected $apiKey;

    /**
     * @var int The page number
     */
    protected $page = 1;

    /**
     * @var int The number of results per page
     */
    protected $perPage;

    /**
     * AbstractClient constructor.
     *
     * @param Client|null $client
     */
    public function __construct(Client $client = null)
    {
        $this->client = $client ?? new Client();
    }

    /**
     * Sets the Api key in header for authentication
     *
     * @param string $apiKey The Api key
     *
     * @return static
     */
    public function setApiKey(string $apiKey): self
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * Sets the Api url
     *
     * @param string $url The Api url
     *
     * @return static
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Returns the API url.
     *
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * Sets number of results per page
     *
     * @param int $perPage
     *
     * @return AbstractClient
     */
    public function setPerPage(int $perPage): self
    {
        $this->perPage = $perPage;

        return $this;
    }

    /**
     * Sets the page number
     *
     * @param int $page
     *
     * @return AbstractClient
     */
    public function setPage(int $page): self
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Sends a GET request and returns the response
     *
     * @param array $parameters
     * @param array $headers
     *
     * @return string
     *
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    protected function get(array $parameters = [], array $headers = []): string
    {
        $response = $this->client->request(
            'get',
            $this->generateUrl($parameters),
            [
                'headers' => $this->prepareHeaders($headers),
            ]
        );

        return $this->getResponse($response);
    }

    /**
     * @param ResponseInterface $response
     *
     * @return StreamInterface
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    private function getResponse(ResponseInterface $response): StreamInterface
    {
        $statusCode = $response->getStatusCode();
        if ($statusCode === 404) {
            throw new NotFoundException(sprintf('Resource not found on URL %s', $this->getUrl()));
        }

        if ($statusCode >= 400 && $statusCode <= 599) {
            throw new PublicApiClientException(sprintf(
                'Error: status code: %s. URL: %s',
                $statusCode,
                $this->getUrl()
            ));
        }

        return $response->getBody();
    }

    /**
     * Decodes the JSON response to an array or throws an exception if it's not possible.
     *
     * @param string $rawResponse
     *
     * @return array
     *
     * @throws PublicApiClientException
     */
    public function decodeResponse(string $rawResponse): array
    {
        $response = json_decode($rawResponse, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new PublicApiClientException(sprintf('Error: Unable to decode JSON response. Raw response was: "%s"', $rawResponse));
        }

        return $response;
    }

    /**
     * @param array $headers
     *
     * @return array
     */
    private function prepareHeaders(array $headers): array
    {
        return array_merge(
            [
                self::API_KEY => $this->apiKey,
            ],
            $headers
        );
    }

    /**
     * Sends a POST request and returns the response
     *
     * @param array $payload
     * @param array $parameters
     * @param array $headers
     *
     * @return StreamInterface
     *
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    protected function post(array $payload, array $parameters = [], array $headers = []): StreamInterface
    {
        $response = $this->client->request(
            'post',
            $this->generateUrl($parameters),
            [
                'headers' => $this->prepareHeaders($headers),
                'body'    => json_encode($payload),
            ]
        );

        return $this->getResponse($response);
    }

    /**
     * Sends a PUT request and returns the response
     *
     * @param string $payload
     * @param array $parameters
     * @param array $headers
     *
     * @return StreamInterface
     *
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    protected function put(string $payload = '', array $parameters = [], array $headers = []): StreamInterface
    {
        $response = $this->client->request(
            'put',
            $this->generateUrl($parameters),
            [
                'headers' => $this->prepareHeaders($headers),
                'body'    => $payload,
            ]
        );

        return $this->getResponse($response);
    }

    /**
     * Generates the full url for request
     *
     * @param array $parameters
     *
     * @return string
     */
    protected function generateUrl(array $parameters = []): string
    {
        $params = array_merge($parameters, $this->generatePagination());

        $paramsStr = '';
        if (count($params) !== 0) {
            $query = http_build_query($params);
            $query = preg_replace('/%5B[0-9]+%5D/simU', '%5B%5D', $query);
            $paramsStr = '?' . $query;
        }

        return $this->url . $this->basePath . $this->path . $paramsStr;
    }

    /**
     * Generates the pagination part of the url
     *
     * @return array
     */
    private function generatePagination(): array
    {
        if ($this->page === 1 && empty($this->perPage)) {
            return [];
        }

        $params = [];

        if ($this->page > 1) {
            $params[static::PAGE] = $this->page;
        }

        if ($this->perPage > 0) {
            $params[static::PER_PAGE] = $this->perPage;
        }

        return $params;
    }

    /**
     * Sends a DELETE request and returns the response
     *
     * @param array $parameters
     * @param array $headers
     *
     * @return string
     *
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    protected function delete(array $parameters = [], array $headers = []): string
    {
        $response = $this->client->request(
            'delete',
            $this->generateUrl($parameters),
            [
                'headers' => $this->prepareHeaders($headers),
            ]
        );

        return $this->getResponse($response);
    }
}
