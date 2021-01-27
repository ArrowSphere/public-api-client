<?php

namespace ArrowSphere\PublicApiClient\Tests\General;

use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use ArrowSphere\PublicApiClient\General\CheckDomainClient;
use ArrowSphere\PublicApiClient\Tests\AbstractClientTest;
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
     */
    public function testCheckDomainRaw(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('get')
            ->with('https://www.test.com/vendors/foo/checkDomain/bar')
            ->willReturn(new Response(200, [], 'OK USA'));

        $this->client->checkDomainRaw('foo', 'bar');
    }

    /**
     * @depends testCheckDomainRaw
     * @throws PublicApiClientException
     */
    public function testCheckDomainWithInvalidResponse(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('get')
            ->with('https://www.test.com/vendors/foo/checkDomain/bar')
            ->willReturn(new Response(200, [], '{'));

        $this->expectException(PublicApiClientException::class);
        $this->client->checkDomain('foo', 'bar');
    }

    /**
     * @depends testCheckDomainRaw
     * @throws PublicApiClientException
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
            ->method('get')
            ->with('https://www.test.com/vendors/foo/checkDomain/bar')
            ->willReturn(new Response(200, [], $response));

        self::assertTrue($this->client->checkDomain('foo', 'bar'));
    }

    /**
     * @depends testCheckDomainRaw
     * @throws PublicApiClientException
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
            ->method('get')
            ->with('https://www.test.com/vendors/foo/checkDomain/bar')
            ->willReturn(new Response(200, [], $response));

        self::assertFalse($this->client->checkDomain('foo', 'bar'));
    }
}
