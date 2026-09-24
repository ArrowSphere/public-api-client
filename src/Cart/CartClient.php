<?php

namespace ArrowSphere\PublicApiClient\Cart;

use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use GuzzleHttp\Exception\GuzzleException;

class CartClient extends AbstractCartClient
{
    /**
     * @param array $queryParams
     *
     * @return array
     *
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function listCartItems(array $queryParams = []): array
    {
        $this->path = '';
        $response = $this->get($queryParams);

        return $this->getResponseData($response);
    }

    /**
     * @param string $customerRef
     * @param array $queryParams
     *
     * @return array
     *
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function changeCustomer(string $customerRef, array $queryParams = []): array
    {
        $this->path = '/changeCustomer';
        $response = $this->post(['customerRef' => $customerRef], $queryParams);

        return $this->getResponseData($response->__toString());
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

        return $this->patch($payload)->__toString();
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

        return $this->getResponseData($response->__toString());
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
