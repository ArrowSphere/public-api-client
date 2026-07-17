<?php

namespace ArrowSphere\PublicApiClient\Tests\OrganizationUnits;

use ArrowSphere\PublicApiClient\Exception\EntityValidationException;
use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use ArrowSphere\PublicApiClient\OrganizationUnits\Entities\OrganizationUnit;
use ArrowSphere\PublicApiClient\OrganizationUnits\Entities\OrganizationUnitsResponse;
use ArrowSphere\PublicApiClient\OrganizationUnits\OrganizationUnitsClient;
use ArrowSphere\PublicApiClient\Tests\AbstractClientTest;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;

/**
 * Class OrganizationUnitsClientTest
 *
 * @property OrganizationUnitsClient $client
 */
class OrganizationUnitsClientTest extends AbstractClientTest
{
    protected const MOCKED_CLIENT_CLASS = OrganizationUnitsClient::class;

    /**
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function testGetOrganizationUnitsRaw(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/organizationUnit/')
            ->willReturn(new Response(200, [], 'OK'));

        $this->client->getOrganizationUnitsRaw();
    }

    /**
     * @depends testGetOrganizationUnitsRaw
     *
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function testGetOrganizationUnitsWithInvalidResponse(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/organizationUnit/?per_page=100')
            ->willReturn(new Response(200, [], '{'));

        $this->expectException(PublicApiClientException::class);
        $units = $this->client->getOrganizationUnits();
        iterator_to_array($units);
    }

    /**
     * @depends testGetOrganizationUnitsWithInvalidResponse
     *
     * @throws EntityValidationException
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function testGetOrganizationUnits(): void
    {
        $response = <<<JSON
{
    "status": 200,
    "data": [
        {
            "organizationUnitRef": "OU-REF-001",
            "companyRef": "COMPANY-001",
            "name": "Unit Alpha",
            "countUsers": 5,
            "countCustomers": 3
        },
        {
            "organizationUnitRef": "OU-REF-002",
            "companyRef": "COMPANY-001",
            "name": "Unit Beta",
            "countUsers": 10,
            "countCustomers": 7
        }
    ],
    "pagination": {
        "per_page": 100,
        "current_page": 1,
        "total_page": 1,
        "total": 2,
        "next": null,
        "previous": null
    }
}
JSON;

        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/organizationUnit/?per_page=100')
            ->willReturn(new Response(200, [], $response));

        $units = $this->client->getOrganizationUnits();
        $list = iterator_to_array($units);
        self::assertCount(2, $list);

        /** @var OrganizationUnit $unit */
        $unit = array_shift($list);
        self::assertInstanceOf(OrganizationUnit::class, $unit);
        self::assertSame('OU-REF-001', $unit->getOrganizationUnitRef());
        self::assertSame('COMPANY-001', $unit->getCompanyRef());
        self::assertSame('Unit Alpha', $unit->getName());
        self::assertSame(5, $unit->getCountUsers());
        self::assertSame(3, $unit->getCountCustomers());

        /** @var OrganizationUnit $unit */
        $unit = array_shift($list);
        self::assertInstanceOf(OrganizationUnit::class, $unit);
        self::assertSame('OU-REF-002', $unit->getOrganizationUnitRef());
        self::assertSame('COMPANY-001', $unit->getCompanyRef());
        self::assertSame('Unit Beta', $unit->getName());
        self::assertSame(10, $unit->getCountUsers());
        self::assertSame(7, $unit->getCountCustomers());
    }

    /**
     * @throws EntityValidationException
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function testGetOrganizationUnitsPage(): void
    {
        $response = <<<JSON
{
    "status": 200,
    "data": [
        {
            "organizationUnitRef": "OU-REF-001",
            "companyRef": "COMPANY-001",
            "name": "Unit Alpha",
            "countUsers": 5,
            "countCustomers": 3
        }
    ],
    "pagination": {
        "per_page": 100,
        "current_page": 1,
        "total_page": 1,
        "total": 1,
        "next": null,
        "previous": null
    }
}
JSON;

        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/organizationUnit/?per_page=100')
            ->willReturn(new Response(200, [], $response));

        $page = $this->client->getOrganizationUnitsPage();

        self::assertInstanceOf(OrganizationUnitsResponse::class, $page);
        $units = $page->getOrganizationUnits();
        self::assertCount(1, $units);
        self::assertSame('OU-REF-001', $units[0]->getOrganizationUnitRef());
        self::assertSame(1, $page->getPagination()->getTotalPage());
    }

    /**
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function testGetOrganizationUnit(): void
    {
        $response = <<<JSON
{
    "status": 200,
    "data": {
        "organizationUnitRef": "OU-REF-001",
        "companyRef": "COMPANY-001",
        "name": "Unit Alpha",
        "countUsers": 5,
        "countCustomers": 3
    }
}
JSON;

        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/organizationUnit/ouRef/OU-REF-001')
            ->willReturn(new Response(200, [], $response));

        $unit = $this->client->getOrganizationUnit('OU-REF-001');

        self::assertInstanceOf(OrganizationUnit::class, $unit);
        self::assertSame('OU-REF-001', $unit->getOrganizationUnitRef());
        self::assertSame('COMPANY-001', $unit->getCompanyRef());
        self::assertSame('Unit Alpha', $unit->getName());
        self::assertSame(5, $unit->getCountUsers());
        self::assertSame(3, $unit->getCountCustomers());
    }

    /**
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function testCreateOrganizationUnit(): void
    {
        $organizationUnit = new OrganizationUnit([
            'organizationUnitRef' => '',
            'companyRef' => 'COMPANY-001',
            'name' => 'Unit Alpha',
            'countUsers' => 0,
            'countCustomers' => 0,
        ]);

        $response = <<<JSON
{
    "status": 201,
    "data": {
        "organizationUnitRef": "OU-REF-001",
        "companyRef": "COMPANY-001",
        "name": "Unit Alpha",
        "countUsers": 0,
        "countCustomers": 0
    }
}
JSON;

        $expectedPayload = [
            'companyRef' => 'COMPANY-001',
            'name' => 'Unit Alpha',
        ];

        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('post', 'https://www.test.com/organizationUnit/', [
                'headers' => [
                    'apiKey' => '123456',
                    'Content-Type' => 'application/json',
                    'User-Agent' => $this->userAgentHeader,
                ],
                'body' => json_encode($expectedPayload),
            ])
            ->willReturn(new Response(200, [], $response));

        $created = $this->client->createOrganizationUnit($organizationUnit);

        self::assertInstanceOf(OrganizationUnit::class, $created);
        self::assertSame('OU-REF-001', $created->getOrganizationUnitRef());
        self::assertSame('COMPANY-001', $created->getCompanyRef());
        self::assertSame('Unit Alpha', $created->getName());
    }

    /**
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function testUpdateOrganizationUnit(): void
    {
        $organizationUnit = new OrganizationUnit([
            'organizationUnitRef' => 'OU-REF-001',
            'companyRef' => 'COMPANY-001',
            'name' => 'Unit Alpha Updated',
            'countUsers' => 5,
            'countCustomers' => 3,
        ]);

        $response = <<<JSON
{
    "status": 200,
    "data": {
        "organizationUnitRef": "OU-REF-001",
        "companyRef": "COMPANY-001",
        "name": "Unit Alpha Updated",
        "countUsers": 5,
        "countCustomers": 3
    }
}
JSON;

        $expectedPayload = [
            'organizationUnitRef' => 'OU-REF-001',
            'companyRef' => 'COMPANY-001',
            'name' => 'Unit Alpha Updated',
        ];

        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('patch', 'https://www.test.com/organizationUnit/ouRef/OU-REF-001', [
                'headers' => [
                    'apiKey' => '123456',
                    'Content-Type' => 'application/json',
                    'User-Agent' => $this->userAgentHeader,
                ],
                'body' => json_encode($expectedPayload),
            ])
            ->willReturn(new Response(200, [], $response));

        $updated = $this->client->updateOrganizationUnit($organizationUnit);

        self::assertInstanceOf(OrganizationUnit::class, $updated);
        self::assertSame('OU-REF-001', $updated->getOrganizationUnitRef());
        self::assertSame('Unit Alpha Updated', $updated->getName());
    }

    /**
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function testDeleteOrganizationUnit(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('delete', 'https://www.test.com/organizationUnit/ouRef/OU-REF-001')
            ->willReturn(new Response(204, [], ''));

        $this->client->deleteOrganizationUnit('OU-REF-001');
    }
}
