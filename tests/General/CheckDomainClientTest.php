<?php

namespace ArrowSphere\PublicApiClient\Tests\General;

use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use ArrowSphere\PublicApiClient\General\CheckDomainClient;
use ArrowSphere\PublicApiClient\Tests\AbstractClientTest;

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
        $this->curler->response = 'OK USA';

        $this->curler->expects(self::once())
            ->method('get')
            ->with('https://www.test.com/vendors/foo/checkDomain/bar');

        $this->client->checkDomainRaw('foo', 'bar');
    }

    /**
     * @depends testCheckDomainRaw
     * @throws PublicApiClientException
     */
    public function testCheckDomainWithInvalidResponse(): void
    {
        $this->curler->response = '{';

        $this->expectException(PublicApiClientException::class);
        $this->client->checkDomain('foo', 'bar');
    }

    /**
     * @depends testCheckDomainRaw
     * @throws PublicApiClientException
     */
    public function testCheckDomain(): void
    {
        $this->curler->response = <<<JSON
{
  "status": 200,
  "data": {
    "isDomainAvailable": true
  }
}
JSON;

        $this->curler->expects(self::once())
            ->method('get')
            ->with('https://www.test.com/vendors/foo/checkDomain/bar');

        self::assertTrue($this->client->checkDomain('foo', 'bar'));
    }

    /**
     * @depends testCheckDomainRaw
     * @throws PublicApiClientException
     */
    public function testCheckDomainFalse(): void
    {
        $this->curler->response = <<<JSON
{
  "status": 200,
  "data": {
    "isDomainAvailable": false
  }
}
JSON;

        $this->curler->expects(self::once())
            ->method('get')
            ->with('https://www.test.com/vendors/foo/checkDomain/bar');

        self::assertFalse($this->client->checkDomain('foo', 'bar'));
    }
}
