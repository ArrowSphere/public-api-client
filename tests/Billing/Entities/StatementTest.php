<?php

namespace ArrowSphere\PublicApiClient\Tests\Billing\Entities;

use ArrowSphere\PublicApiClient\Billing\Entities\Statement;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

/**
 * Class StatementTest
 */
class StatementTest extends AbstractEntityTest
{
    protected const CLASS_NAME = Statement::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields' => [
                    'reference' => 'H1-MSM-deadbeefdeadbeefdeadbeefdeadbeef',
                    'sequence' => 'MSM21-123456789',
                    'billingGroup' => 'ArrowBilling',
                    'billingStrategy' => 'mscsp-saas-monthly',
                    'vendorName' => 'microsoft',
                    'programCode' => 'MSCSP',
                    'classification' => 'saas',
                    'reportPeriod' => '2021-04',
                    'marketplace' => 'US',
                    'issueDate' => '2021-04-29 13:37:00',
                    'from' => [
                        'reference' => 'XSP1337',
                        'name' => 'Reseller',
                    ],
                    'to' => [
                        'reference' => 'XSP123',
                        'name' => 'Customer',
                    ],
                    'currency' => 'USD',
                    'prices' => [
                        'listTotal' => 45.1,
                        'buyTotal' => 42.05,
                        'sellTotal' => 23.1,
                    ],
                    'description' => 'rule1',
                ],
                'expected' => <<<JSON
{
    "reference": "H1-MSM-deadbeefdeadbeefdeadbeefdeadbeef",
    "sequence": "MSM21-123456789",
    "billingGroup": "ArrowBilling",
    "billingStrategy": "mscsp-saas-monthly",
    "vendorName": "microsoft",
    "programCode": "MSCSP",
    "classification": "saas",
    "reportPeriod": "2021-04",
    "marketplace": "US",
    "issueDate": "2021-04-29 13:37:00",
    "from": {
        "reference": "XSP1337",
        "name": "Reseller"
    },
    "to": {
        "reference": "XSP123",
        "name": "Customer"
    },
    "currency": "USD",
    "prices": {
        "listTotal": 45.1,
        "buyTotal": 42.05,
        "sellTotal": 23.1
    },
    "description": "rule1",
    "status": null
}
JSON
            ],
        ];
    }
}
