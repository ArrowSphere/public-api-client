<?php

namespace ArrowSphere\PublicApiClient\Tests\Customers\Entities;

use ArrowSphere\PublicApiClient\Customers\Entities\CompanyDetails;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

/**
 * Class CompanyDetailsTest
 */
class CompanyDetailsTest extends AbstractEntityTest
{
    protected const CLASS_NAME = CompanyDetails::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'DomainName'        => 'example.com',
                    'IBMCeId'           => 'ibm CE Id',
                    'Maas360ResellerId' => 'Maas 360 Reseller Id',
                    'Migration'         => false,
                    'OracleOnlineKey'   => 'oracle online key',
                    'TenantId'          => 'tenant id',
                ],
                'expected' => <<<JSON
{
    "DomainName": "example.com",
    "IBMCeId": "ibm CE Id",
    "Maas360ResellerId": "Maas 360 Reseller Id",
    "Migration": false,
    "OracleOnlineKey": "oracle online key",
    "TenantId": "tenant id"
}
JSON
                ,
            ],
        ];
    }

    public function testSerializationOmitsMissingDetails(): void
    {
        self::assertSame('[]', json_encode(new CompanyDetails([])));
        self::assertSame('{"Migration":false}', json_encode(new CompanyDetails(['Migration' => false, 'TenantId' => null])));
    }
}
