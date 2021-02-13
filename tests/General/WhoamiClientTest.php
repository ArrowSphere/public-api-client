<?php

namespace ArrowSphere\PublicApiClient\Tests\General;

use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use ArrowSphere\PublicApiClient\General\WhoamiClient;
use ArrowSphere\PublicApiClient\Tests\AbstractClientTest;
use GuzzleHttp\Psr7\Response;

/**
 * Class CategoryClientTest
 *
 * @property WhoamiClient $client
 */
class WhoamiClientTest extends AbstractClientTest
{
    protected const MOCKED_CLIENT_CLASS = WhoamiClient::class;

    /**
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function testGetWhoamiRaw(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/whoami')
            ->willReturn(new Response(200, [], 'OK USA'));

        $this->client->getWhoamiRaw();
    }

    /**
     * @depends testGetWhoamiRaw
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function testGetWhoamiWithInvalidResponse(): void
    {
        $this->httpClient
            ->method('request')
            ->with('get', 'https://www.test.com/whoami')
            ->willReturn(new Response(200, [], '{'));

        $this->expectException(PublicApiClientException::class);
        $this->client->getWhoami();
    }

    /**
     * @depends testGetWhoamiRaw
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function testGetWhoami(): void
    {
        $response = <<<JSON
{
  "status": 200,
  "data": {
    "companyName": "Wayne industries",
    "addressLine1": "1007 Mountain Drive",
    "addressLine2": "Wayne Manor",
    "zip": "12345",
    "city": "Gotham City",
    "countryCode": "US",
    "state": "NJ",
    "receptionPhone": "1-800-555-1111",
    "websiteUrl": "https://www.dccomics.com",
    "emailContact": "nobody@example.com",
    "headcount": null,
    "taxNumber": "",
    "reference": "XSP12345",
    "ref": "COMPANY12345",
    "billingId": "",
    "internalReference": ""
  }
}
JSON;

        $this->httpClient->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/whoami')
            ->willReturn(new Response(200, [], $response));

        $test = $this->client->getWhoami();

        self::assertEquals('Wayne industries', $test->getCompanyName());
        self::assertEquals('1007 Mountain Drive', $test->getAddressLine1());
        self::assertEquals('Wayne Manor', $test->getAddressLine2());
        self::assertEquals('12345', $test->getZip());
        self::assertEquals('Gotham City', $test->getCity());
        self::assertEquals('US', $test->getCountryCode());
        self::assertEquals('NJ', $test->getState());
        self::assertEquals('1-800-555-1111', $test->getReceptionPhone());
        self::assertEquals('https://www.dccomics.com', $test->getWebsiteUrl());
        self::assertEquals('nobody@example.com', $test->getEmailContact());
        self::assertNull($test->getHeadcount());
        self::assertEquals('', $test->getTaxNumber());
        self::assertEquals('XSP12345', $test->getReference());
        self::assertEquals('COMPANY12345', $test->getRef());
        self::assertEquals('', $test->getBillingId());
        self::assertEquals('', $test->getInternalReference());
    }
}
