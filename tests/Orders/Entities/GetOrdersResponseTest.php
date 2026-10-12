<?php

namespace ArrowSphere\PublicApiClient\Tests\Orders\Entities;

use ArrowSphere\PublicApiClient\Orders\Entities\GetOrdersResponse;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class GetOrdersResponseTest extends AbstractEntityTest
{
    protected const CLASS_NAME = GetOrdersResponse::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'data'       => [
                        'orders' => [
                            [
                                'reference'             => 'my reference',
                                'status'                => 'my status',
                                'dateStatus'            => 'my date status',
                                'dateCreation'          => 'my date creation',
                                'order_reference'       => 'my order reference',
                                'createdBy'             => 'my created by',
                                'createdByImpersonator' => 'my created by impersonator',
                                'commitmentAmountTotal' => 12.5,
                                'partner'               => [
                                    'companyName' => 'my company name',
                                    'contact'     => [
                                        'email'     => 'my email',
                                        'firstName' => 'my first name',
                                        'lastName'  => 'my last name',
                                    ],
                                ],
                                'customer'              => [
                                    'reference' => 'my reference',
                                ],
                                'ponumber'              => 'my po number',
                                'products'              => [
                                    [
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
                                ],
                                'extraInformation'      => [
                                    'programs' => [
                                        'key' => 'value',
                                    ],
                                ],
                                'scheduledDate'         => 'my scheduled date',
                            ],
                        ],
                    ],
                    'pagination' => [
                        'per_page'     => 10,
                        'current_page' => 1,
                        'total_page'   => 1,
                        'total'        => 1,
                        'next'         => '',
                        'previous'     => '',
                    ],
                ],
                'expected' => <<<JSON
{
    "orders": [
        {
            "reference": "my reference",
            "status": "my status",
            "dateStatus": "my date status",
            "dateCreation": "my date creation",
            "order_reference": "my order reference",
            "createdBy": "my created by",
            "createdByImpersonator": "my created by impersonator",
            "commitmentAmountTotal": 12.5,
            "partner": {
                "companyName": "my company name",
                "contact": {
                    "email": "my email",
                    "firstName": "my first name",
                    "lastName": "my last name"
                }
            },
            "customer": {
                "reference": "my reference"
            },
            "ponumber": "my po number",
            "products": [
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
            ],
            "extraInformation": {
                "programs": {
                    "key": "value"
                }
            },
            "scheduledDate": "my scheduled date"
        }
    ],
    "pagination": {
        "per_page": 10,
        "current_page": 1,
        "total_page": 1,
        "total": 1,
        "next": "",
        "previous": ""
    }
}
JSON
                ,
            ],
        ];
    }
}
