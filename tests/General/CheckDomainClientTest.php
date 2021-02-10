<?php

namespace ArrowSphere\PublicApiClient\Tests\General;

use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use ArrowSphere\PublicApiClient\General\CheckDomainClient;
use ArrowSphere\PublicApiClient\Tests\AbstractClientTest;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;

/**
 * Class CheckDomainClientTest
 *
 * @property CheckDomainClient $client
 */
class CheckDomainClientTest extends AbstractClientTest
{
    protected const MOCKED_CLIENT_CLASS = CheckDomainClient::class;

    /**
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function testCheckDomainRaw(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/vendors/foo/checkDomain/bar?abc=def&ghi=0')
            ->willReturn(new Response(200, [], 'OK USA'));

        $this->client->checkDomainRaw('foo', 'bar', [
            'abc' => 'def',
            'ghi' => false,
        ]);
    }

    /**
     * @depends testCheckDomainRaw
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function testCheckDomainWithInvalidResponse(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/vendors/foo/checkDomain/bar?abc=def&ghi=0')
            ->willReturn(new Response(200, [], '{'));

        $this->expectException(PublicApiClientException::class);
        $this->client->checkDomain('foo', 'bar', [
            'abc' => 'def',
            'ghi' => false,
        ]);
    }

    /**
     * @depends testCheckDomainRaw
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function testCheckDomain(): void
    {
        $response = <<<JSON
{
  "status": 200,
  "data": {
    "isDomainAvailable": true
  }
}
JSON;

        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/vendors/foo/checkDomain/bar?abc=def&ghi=0')
            ->willReturn(new Response(200, [], $response));

        self::assertTrue($this->client->checkDomain('foo', 'bar', [
            'abc' => 'def',
            'ghi' => false,
        ]));
    }

    /**
     * @depends testCheckDomainRaw
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function testCheckDomainFalse(): void
    {
        $response = <<<JSON
{
  "status": 200,
  "data": {
    "isDomainAvailable": false
  }
}
JSON;

        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/vendors/foo/checkDomain/bar?abc=def&ghi=0')
            ->willReturn(new Response(200, [], $response));

        self::assertFalse($this->client->checkDomain('foo', 'bar', [
            'abc' => 'def',
            'ghi' => false,
        ]));
    }
}
