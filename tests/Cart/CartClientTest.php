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
    protected const MOCKED_CLIENT_CLASS = CartClient::class;

    private const ITEM_ID = '70993353-0db8-4d12-8880-d6eece73f93f';

    /**
     * @return array
     */
    public function generateMockedCartItem(): array
    {
        return [
            'itemId'                  => self::ITEM_ID,
            'offerName'               => 'Microsoft 365 standard',
            'priceBandArrowsphereSku' => '031C9E47-4802-4248-838E-778FB1D2CC05',
            'quantity'                => 5
        ];
    }

    /**
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function testListCartItems(): void
    {
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
        $itemId = self::ITEM_ID;
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
        $payload = $this->generateMockedCartItem();
        unset($payload['itemId']);

        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('post', "https://www.test.com/cart")
            ->willReturn(new Response(200, [], json_encode($this->generateMockedCartItem())));

        $this->client->AddCartItem($payload);
    }

    /**
     * @throws NotFoundException
     * @throws GuzzleException
     * @throws PublicApiClientException
     */
    public function testRemoveOneCartItem(): void
    {
        $itemId = self::ITEM_ID;
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
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('delete', "https://www.test.com/cart")
            ->willReturn(new Response(200, []));

        $this->client->emptyCart();
    }
}
