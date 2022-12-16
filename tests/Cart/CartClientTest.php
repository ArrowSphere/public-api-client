<?php

namespace ArrowSphere\PublicApiClient\Tests\Cart;

use ArrowSphere\PublicApiClient\Cart\CartClient;
use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use ArrowSphere\PublicApiClient\Tests\AbstractClientTest;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;

/**
 * Class CartClientTest
 *
 * @property CartClient $client
 */
class CartClientTest extends AbstractClientTest
{
    use CartMockedDataTrait;

    protected const MOCKED_CLIENT_CLASS = CartClient::class;

    /**
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function testListCartItems(): void
    {
        $this->client->setIdToken($this->idToken);
        $this->client->setDefaultHeaders($this->generateDefaultHeaders());
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/cart')
            ->willReturn(new Response(200, [], json_encode($this->generateMockedCartItem())));

        $this->client->listCartItems();
    }

    /**
     * @throws NotFoundException
     * @throws GuzzleException
     * @throws PublicApiClientException
     */
    public function testPatchOneCartItem(): void
    {
        $itemId = $this->itemId;
        $this->client->setIdToken($this->idToken);
        $this->client->setDefaultHeaders($this->generateDefaultHeaders());
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('patch', "https://www.test.com/cart/$itemId")
            ->willReturn(new Response(200, [], json_encode($this->generateMockedCartItem())));

        $this->client->patchUpdateOneCartItem($itemId, $this->generateMockedCartItem());
    }

    /**
     * @throws NotFoundException
     * @throws GuzzleException
     * @throws PublicApiClientException
     */
    public function testAddCartItem(): void
    {
        $paylaod = $this->generateMockedCartItem();
        unset($paylaod['itemId']);

        $this->client->setIdToken($this->idToken);
        $this->client->setDefaultHeaders($this->generateDefaultHeaders());
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('post', "https://www.test.com/cart")
            ->willReturn(new Response(200, [], json_encode($this->generateMockedCartItem())));

        $this->client->AddCartItem($paylaod);
    }

    /**
     * @throws NotFoundException
     * @throws GuzzleException
     * @throws PublicApiClientException
     */
    public function testRemoveOneCartItem(): void
    {
        $itemId = $this->itemId;
        $this->client->setIdToken($this->idToken);
        $this->client->setDefaultHeaders($this->generateDefaultHeaders());
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('delete', "https://www.test.com/cart/$itemId")
            ->willReturn(new Response(200, []));

        $this->client->removeOneCartItem($itemId);
    }

    /**
     * @throws NotFoundException
     * @throws GuzzleException
     * @throws PublicApiClientException
     */
    public function testEmptyCart(): void
    {
        $this->client->setIdToken($this->idToken);
        $this->client->setDefaultHeaders($this->generateDefaultHeaders());
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('delete', "https://www.test.com/cart")
            ->willReturn(new Response(200, []));

        $this->client->emptyCart();
    }
}
