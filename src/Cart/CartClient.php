<?php

namespace ArrowSphere\PublicApiClient\Cart;

use ArrowSphere\PublicApiClient\AbstractClient;
use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use GuzzleHttp\Exception\GuzzleException;

class CartClient extends AbstractClient
{
    /**
     * @var string The base path of the Cart API
     */
    private const ROOT_PATH = '/cart';

    /**
     * @var string The base path of the API
     */
    protected $basePath = self::ROOT_PATH;

    /**
     * @return array
     *
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function listCartItems(): array
    {
        $this->path = '';
        $response = $this->get();

        return $this->getResponseData($response);
    }

    /**
     * @param string $itemId
     * @param array $payload
     *
     * @return string
     *
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function patchUpdateOneCartItem(string $itemId, array $payload): string
    {
        $this->path = '/' . urlencode($itemId);

        return $this->patch($payload);
    }

    /**
     * @param array $payload
     *
     * @return array
     *
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function AddCartItem(array $payload): array
    {
        $this->path = '';
        $response = $this->post($payload);

        return $this->getResponseData($response);
    }

    /**
     * @param string $itemId
     *
     * @return string
     *
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function removeOneCartItem(string $itemId): string
    {
        $this->path = '/' . urlencode($itemId);

        return $this->delete();
    }

    /**
     * @return string
     *
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function emptyCart(): string
    {
        $this->path = '';

        return $this->delete();
    }
}
