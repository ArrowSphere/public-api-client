<?php

namespace ArrowSphere\PublicApiClient\Tests\Catalog;

use ArrowSphere\PublicApiClient\Catalog\Entities\Family;
use ArrowSphere\PublicApiClient\Catalog\FamilyClient;
use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use ArrowSphere\PublicApiClient\Tests\AbstractClientTest;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;

/**
 * Class FamilyClientTest
 *
 * @property FamilyClient $client
 */
class FamilyClientTest extends AbstractClientTest
{
    protected const MOCKED_CLIENT_CLASS = FamilyClient::class;

    /**
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function testGetFamiliesRaw(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/catalog/families/microsoft?abc=def&ghi=0')
            ->willReturn(new Response(200, [], 'OK USA'));

        $this->client->getFamiliesRaw('microsoft', [
            'abc' => 'def',
            'ghi' => false,
        ]);
    }

    /**
     * @depends testGetFamiliesRaw
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function testGetFamiliesWithInvalidResponse(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/catalog/families/microsoft?abc=def&ghi=0&per_page=100')
            ->willReturn(new Response(200, [], '{'));

        $this->expectException(PublicApiClientException::class);
        $families = $this->client->getFamilies('microsoft', [
            'abc' => 'def',
            'ghi' => false,
        ]);
        iterator_to_array($families);
    }

    /**
     * @depends testGetFamiliesRaw
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function testGetFamiliesWithPagination(): void
    {
        $response = json_encode([
            'data'       => [],
            'pagination' => [
                'total_page' => 3,
            ],
        ]);

        $this->httpClient
            ->expects(self::exactly(3))
            ->method('request')
            ->withConsecutive(
                ['get', 'https://www.test.com/catalog/families/microsoft?abc=def&ghi=0&per_page=100'],
                ['get', 'https://www.test.com/catalog/families/microsoft?abc=def&ghi=0&page=2&per_page=100'],
                ['get', 'https://www.test.com/catalog/families/microsoft?abc=def&ghi=0&page=3&per_page=100']
            )
            ->willReturn(new Response(200, [], $response));

        $test = $this->client->getFamilies('microsoft', [
            'abc' => 'def',
            'ghi' => false,
        ]);
        iterator_to_array($test);
    }

    /**
     * @depends testGetFamiliesRaw
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function testGetFamilies(): void
    {
        $response = <<<JSON
{
    "status": 200,
    "data": [
        {
            "classification": "SAAS",
            "marketplace": "US",
            "name": "Office 365 Enterprise – (Corporate)",
            "reference": "MS-0B-O365-ENTERPRIS",
            "vendor": "Microsoft",
            "vendorCode": "microsoft"
        },
        {
            "classification": "SAAS",
            "marketplace": "US",
            "name": "Office 365 (Education)",
            "reference": "MS-9B-O365-EDU",
            "vendor": "Microsoft",
            "vendorCode": "microsoft"
        }
    ],
    "pagination": {
        "per_page": 15,
        "current_page": 1,
        "total_page": 1,
        "total": 2,
        "next": "/catalog/families/microsoft?page=2",
        "previous": null
    }
}
JSON;

        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/catalog/families/microsoft?abc=def&ghi=0&per_page=100')
            ->willReturn(new Response(200, [], $response));

        $test = $this->client->getFamilies('microsoft', [
            'abc' => 'def',
            'ghi' => false,
        ]);
        $list = iterator_to_array($test);
        self::assertCount(2, $list);

        /** @var Family $family */
        $family = array_shift($list);
        self::assertInstanceOf(Family::class, $family);
        self::assertEquals('SAAS', $family->getClassification());
        self::assertEquals('US', $family->getMarketplace());
        self::assertEquals('Office 365 Enterprise – (Corporate)', $family->getName());
        self::assertEquals('MS-0B-O365-ENTERPRIS', $family->getReference());
        self::assertEquals('Microsoft', $family->getVendor());
        self::assertEquals('microsoft', $family->getVendorCode());

        /** @var Family $family */
        $family = array_shift($list);
        self::assertInstanceOf(Family::class, $family);
        self::assertEquals('SAAS', $family->getClassification());
        self::assertEquals('US', $family->getMarketplace());
        self::assertEquals('Office 365 (Education)', $family->getName());
        self::assertEquals('MS-9B-O365-EDU', $family->getReference());
        self::assertEquals('Microsoft', $family->getVendor());
        self::assertEquals('microsoft', $family->getVendorCode());
    }

    /**
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function testGetFamilyRaw(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/catalog/families/microsoft/MS-0B-O365-ENTERPRIS?abc=def&ghi=0')
            ->willReturn(new Response(200, [], 'OK USA'));

        $this->client->getFamilyRaw('microsoft', 'MS-0B-O365-ENTERPRIS', [
            'abc' => 'def',
            'ghi' => false,
        ]);
    }

    /**
     * @depends testGetFamilyRaw
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function testGetFamilyWithInvalidResponse(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/catalog/families/microsoft/MS-0B-O365-ENTERPRIS?abc=def&ghi=0')
            ->willReturn(new Response(200, [], '{'));

        $this->expectException(PublicApiClientException::class);
        $this->client->getFamily('microsoft', 'MS-0B-O365-ENTERPRIS', [
            'abc' => 'def',
            'ghi' => false,
        ]);
    }

    /**
     * @depends testGetFamilyRaw
     *
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function testGetFamily(): void
    {
        $response = <<<JSON
{
    "status": 200,
    "data": {
        "classification": "SAAS",
        "marketplace": "US",
        "name": "Office 365 (Education)",
        "reference": "MS-9B-O365-EDU",
        "vendor": "Microsoft",
        "vendorCode": "microsoft"
    }
}
JSON;

        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/catalog/families/microsoft/MS-0B-O365-ENTERPRIS?abc=def&ghi=0')
            ->willReturn(new Response(200, [], $response));

        $family = $this->client->getFamily('microsoft', 'MS-0B-O365-ENTERPRIS', [
            'abc' => 'def',
            'ghi' => false,
        ]);

        self::assertEquals('SAAS', $family->getClassification());
        self::assertEquals('US', $family->getMarketplace());
        self::assertEquals('Office 365 (Education)', $family->getName());
        self::assertEquals('MS-9B-O365-EDU', $family->getReference());
        self::assertEquals('Microsoft', $family->getVendor());
        self::assertEquals('microsoft', $family->getVendorCode());
    }
}
