<?php

namespace ArrowSphere\PublicApiClient\Tests;

use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use ArrowSphere\PublicApiClient\General\WhoamiClient;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;

/**
 * Tests the configuration accessors of AbstractClient, through a concrete client.
 *
 * @property WhoamiClient $client
 */
class AbstractClientConfigurationTest extends AbstractClientTest
{
    protected const MOCKED_CLIENT_CLASS = WhoamiClient::class;

    public function testExposesItsConfiguration(): void
    {
        self::assertSame($this->httpClient, $this->client->getClient());
        self::assertSame('https://www.test.com', $this->client->getUrl());
        self::assertSame('123456', $this->client->getApiKey());
        self::assertNull($this->client->getAccessToken());
        self::assertSame(['Content-Type' => 'application/json'], $this->client->getDefaultHeaders());

        $this->client->setDefaultHeaders(['X-Custom' => 'value']);

        self::assertSame(['X-Custom' => 'value'], $this->client->getDefaultHeaders());
    }

    /**
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function testSendsTheAccessTokenAsAuthorizationHeader(): void
    {
        self::assertSame($this->client, $this->client->setAccessToken('my-access-token'));
        self::assertSame('my-access-token', $this->client->getAccessToken());

        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with(
                'GET',
                'https://www.test.com/whoami',
                self::callback(static function (array $options): bool {
                    return $options['headers']['Authorization'] === 'my-access-token'
                        && $options['headers']['apiKey'] === '123456';
                })
            )
            ->willReturn(new Response(200, [], 'OK'));

        $this->client->getWhoamiRaw();
    }
}
