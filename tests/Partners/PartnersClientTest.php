<?php

namespace ArrowSphere\PublicApiClient\Tests\Partners;

use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use ArrowSphere\PublicApiClient\Partners\PartnersClient;
use ArrowSphere\PublicApiClient\Tests\AbstractClientTest;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;

/**
 * Class PartnersClientTest
 *
 * @property PartnersClient $client
 */
class PartnersClientTest extends AbstractClientTest
{
    protected const MOCKED_CLIENT_CLASS = PartnersClient::class;

    /**
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function testGetContactsRaw(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/partners/contacts')
            ->willReturn(new Response(200, [], 'OK'));

        $this->client->getContactsRaw();
    }

    /**
     * @depends testGetContactsRaw
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function testGetContactsRawWithParameters(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/partners/contacts?vendor=microsoft')
            ->willReturn(new Response(200, [], 'OK'));

        $this->client->getContactsRaw(['vendor' => 'microsoft']);
    }
}
