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
                    'strategy' => 'mscsp-saas-monthly',
                    'group' => 'ArrowBilling',
                    'status' => 'Open',
                    'from' => [
                        'reference' => 'XSP1337',
                        'name' => 'Reseller',
                    ],
                    'to' => [
                        [
                            'reference' => 'XSP123',
                            'name' => 'Customer',
                        ]
                    ],
                    'creationDate' => '2021-05-21 13:37:00',
                    'submissionDate' => '2021-05-22 13:37:00',
                    'issueDate' => '2021-04-29 13:37:00',
                    'marketplace' => 'US',
                    'vendorCurrency' => 'EUR',
                    'vendorResellerTotalBuyPrice' => 43.0,
                    'vendorEndCustomerTotalBuyPrice' => 22.1,
                    'countryCurrency' => 'USD',
                    'countryResellerTotalBuyPrice' => 42.0,
                    'countryEndCustomerTotalBuyPrice' => 23.1,
                ],
                'expected' => <<<JSON
{
    "reference": "H1-MSM-deadbeefdeadbeefdeadbeefdeadbeef",
    "strategy": "mscsp-saas-monthly",
    "group": "ArrowBilling",
    "status": "Open",
    "from": {
        "reference": "XSP1337",
        "name": "Reseller"
    },
    "to": [
        {
            "reference": "XSP123",
            "name": "Customer"
        }
    ],
    "creationDate": "2021-05-21 13:37:00",
    "submissionDate": "2021-05-22 13:37:00",
    "issueDate": "2021-04-29 13:37:00",
    "marketplace": "US",
    "vendorCurrency": "EUR",
    "vendorResellerTotalBuyPrice": 43,
    "vendorEndCustomerTotalBuyPrice": 22.1,
    "countryCurrency": "USD",
    "countryResellerTotalBuyPrice": 42,
    "countryEndCustomerTotalBuyPrice": 23.1
}
JSON
            ],
        ];
    }
}
