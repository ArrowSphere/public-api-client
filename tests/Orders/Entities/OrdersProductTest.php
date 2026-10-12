<?php

namespace ArrowSphere\PublicApiClient\Tests\Orders\Entities;

use ArrowSphere\PublicApiClient\Orders\Entities\OrdersProduct;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class OrdersProductTest extends AbstractEntityTest
{
    protected const CLASS_NAME = OrdersProduct::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'sku'                => 'my sku',
                    'name'               => 'my name',
                    'classification'     => 'my classification',
                    'vendorName'         => 'my vendor name',
                    'programName'        => 'my program name',
                    'program'            => [
                        'legacyCode' => 'my legacy code',
                    ],
                    'identifiers'        => [
                        'vendor' => [
                            'sku' => 'my sku',
                        ],
                    ],
                    'quantity'           => 2,
                    'status'             => 'my status',
                    'dateStatus'         => 'my date status',
                    'detailedStatus'     => 'my detailed status',
                    'isAddon'            => true,
                    'isTrial'            => true,
                    'arrowSubCategories' => [
                        'my arrow sub categories',
                    ],
                    'prices'             => [
                        'buy'             => 12.5,
                        'sell'            => 12.5,
                        'currency'        => 'my currency',
                        'periodicity'     => 'my periodicity',
                        'term'            => 'my term',
                        'periodicityCode' => 2,
                        'termCode'        => 2,
                    ],
                    'subscription'       => [
                        'reference' => 'my reference',
                    ],
                    'license'            => [
                        'reference' => 'my reference',
                    ],
                ],
                'expected' => <<<JSON
{
    "sku": "my sku",
    "name": "my name",
    "classification": "my classification",
    "vendorName": "my vendor name",
    "programName": "my program name",
    "program": {
        "legacyCode": "my legacy code"
    },
    "identifiers": {
        "vendor": {
            "sku": "my sku"
        }
    },
    "quantity": 2,
    "status": "my status",
    "dateStatus": "my date status",
    "detailedStatus": "my detailed status",
    "isAddon": true,
    "isTrial": true,
    "arrowSubCategories": [
        "my arrow sub categories"
    ],
    "prices": {
        "buy": 12.5,
        "sell": 12.5,
        "currency": "my currency",
        "periodicity": "my periodicity",
        "term": "my term",
        "periodicityCode": 2,
        "termCode": 2
    },
    "subscription": {
        "reference": "my reference"
    },
    "license": {
        "reference": "my reference"
    }
}
JSON
                ,
            ],
        ];
    }
}
