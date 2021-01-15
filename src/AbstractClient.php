<?php

namespace ArrowSphere\PublicApiClient;

use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use Curl\Curl;

/**
 * Class AbstractClient for interacting with the Public API endpoints
 *
 * @package ArrowSphere\PublicApiClient
 */
abstract class AbstractClient
{
    /** @var string The xSP api key for authentication on the Public API endpoints */
    private const API_KEY = 'apiKey';

    /** @var string The page keyword for pagination */
    private const PAGE = 'page';

    /** @var string The keyword for number of results per page for pagination */
    private const PER_PAGE = 'per_page';

    /** @var string The base path of the API */
    protected $basePath = '';

    /** @var string The path of the endpoint */
    protected $path = '';

    /** @var Curl The curler */
    protected $curler;

    /** @var string The url of the request */
    protected $url;

    /** @var string The API key */
    protected $apiKey;

    /** @var string The page number */
    protected $page = 1;

    /** @var int The number of results per page */
    protected $perPage;

    /**
     * AbstractClient constructor.
     *
     * @param Curl|null $curler
     */
    public function __construct(Curl $curler = null)
    {
        $this->curler = $curler ?? new Curl();
        $this->curler->setOpt(CURLOPT_FOLLOWLOCATION, true);
        $this->curler->setOpt(CURLOPT_HEADER, false);
    }

    /**
     * Sets the Api key in header for authentication
     *
     * @param string $apiKey The Api key
     *
     * @return AbstractClient
     */
    public function setApiKey(string $apiKey): self
    {
        $this->apiKey = $apiKey;
        $this->curler->setHeader(self::API_KEY, $this->apiKey);

        return $this;
    }

    /**
     * Sets the Api url
     *
     * @param string $url The Api url
     *
     * @return AbstractClient
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
     * @param string $page
     *
     * @return AbstractClient
     */
    public function setPage(string $page): self
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Sends a GET request and returns the response
     *
     * @param array $parameters
     * @return string
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    protected function get(array $parameters = []): string
    {
        $this->curler->get($this->generateUrl($parameters));

        return $this->getResponse();
    }

    /**
     * @return string
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    private function getResponse(): string
    {
        $curler = $this->getCurler();
        if ($curler->http_status_code === 404) {
            throw new NotFoundException(sprintf('Resource not found on URL %s', $this->getUrl()));
        }

        if ($curler->http_status_code >= 400 && $curler->http_status_code <= 599) {
            throw new PublicApiClientException(sprintf(
                'Error: CURL status: %s. URL: %s',
                $curler->http_status_code,
                $this->getUrl()
            ));
        }

        if ($curler->curl_error) {
            throw new PublicApiClientException(sprintf(
                'Error: CURL error: %s. URL: %s',
                $curler->error_message,
                $this->getUrl()
            ));
        }

        return $this->curler->response;
    }

    /**
     * Decodes the JSON response to an array or throws an exception if it's not possible.
     *
     * @param string $rawResponse
     * @return array
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
     * Sends a POST request and returns the response
     *
     * @param array $payload
     *
     * @param array $parameters
     * @return string
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    protected function post(array $payload, array $parameters = []): string
    {
        $this->curler->post($this->generateUrl($parameters), json_encode($payload));

        return $this->getResponse();
    }

    /**
     * Generates the full url for request
     *
     * @param array $parameters
     * @return string
     */
    protected function generateUrl(array $parameters = []): string
    {
        $params = array_merge($parameters, $this->generatePagination());

        $paramsStr = '';
        if (count($params) !== 0) {
            $query = http_build_query($params);
            $query = preg_replace('/%5B[0-9]+%5D/simU', '%5B%5D', $query);
            $paramsStr =  '?' . $query;
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
            $params[self::PAGE] = $this->page;
        }

        if ($this->perPage > 0) {
            $params[self::PER_PAGE] = $this->perPage;
        }

        return $params;
    }

    /**
     * Returns the CURL object.
     *
     * @return Curl
     */
    public function getCurler(): Curl
    {
        return $this->curler;
    }
}
