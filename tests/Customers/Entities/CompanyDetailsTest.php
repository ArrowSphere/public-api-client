<?php

namespace ArrowSphere\PublicApiClient\Tests\Customers\Entities;

use ArrowSphere\PublicApiClient\Customers\Entities\CompanyDetails;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;
use PHPUnit\Framework\TestCase;

/**
 * Class CompanyDetailsTest
 */
class CompanyDetailsTest extends TestCase
{
    /**
     * @throws EntityValidationException
     */
    public function testSerialization(): void
    {
        $companyDetails = new CompanyDetails([
            'DomainName'        => 'example.com',
            'IBMCeId'           => 'ibm CE Id',
            'Maas360ResellerId' => 'Maas 360 Reseller Id',
            'Migration'         => false,
            'OracleOnlineKey'   => 'oracle online key',
            'TenantId'          => 'tenant id',
        ]);

        $expected = <<<JSON
{
    "DomainName": "example.com",
    "IBMCeId": "ibm CE Id",
    "Maas360ResellerId": "Maas 360 Reseller Id",
    "Migration": false,
    "OracleOnlineKey": "oracle online key",
    "TenantId": "tenant id"
}
JSON;

        self::assertSame($expected, json_encode($companyDetails, JSON_PRETTY_PRINT));
    }
}
