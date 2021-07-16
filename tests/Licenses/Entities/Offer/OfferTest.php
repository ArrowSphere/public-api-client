<?php

namespace ArrowSphere\PublicApiClient\Tests\Licenses\Entities\Offer;

use ArrowSphere\PublicApiClient\Licenses\Entities\Offer\Offer;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

/**
 * Class OfferTest
 */
class OfferTest extends AbstractEntityTest
{
    protected const CLASS_NAME = Offer::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'actionFlags'    => [
                        'isAutoRenew'          => true,
                        'isManualProvisioning' => false,
                        'renewalSku'           => false,
                    ],
                    'classification' => 'SaaS',
                    'isEnabled'      => true,
                    'lastUpdate'     => '1955-11-05T21:13:35',
                    'name'           => 'my offer',
                    'priceBand'      => [
                        'isEnabled'       => false,
                        'currency'        => 'USD',
                        'marketplace'     => 'US',
                        'actionFlags'     => [
                            'canBeCancelled'   => true,
                            'canBeReactivated' => true,
                            'canBeSuspended'   => true,
                            'canDecreaseSeats' => true,
                            'canIncreaseSeats' => true,
                        ],
                        'billing'         => [
                            'cycle' => 720,
                            'term'  => 8640,
                            'type'  => 'my type',
                        ],
                        'prices'          => [
                            'buy'    => 12.34,
                            'sell'   => 56.78,
                            'public' => 98.76,
                        ],
                        'saleConstraints' => [
                            'minQuantity' => 12,
                            'maxQuantity' => 56,
                        ],
                        'identifiers'     => [
                            'arrowsphere' => [
                                'sku' => 'IBM_5737A82_DK_MS_EMM_PRE_PROD_1M_USD_1_999'
                            ]
                        ]
                    ],
                    'arrowSubCategories'  => [
                        'nce'
                    ]
                ],
                'expected' => <<<JSON
{
    "actionFlags": {
        "isAutoRenew": true,
        "isManualProvisioning": false,
        "renewalSku": false
    },
    "classification": "SaaS",
    "isEnabled": true,
    "lastUpdate": "1955-11-05T21:13:35",
    "name": "my offer",
    "priceBand": {
        "actionFlags": {
            "canBeCancelled": true,
            "canBeReactivated": true,
            "canBeSuspended": true,
            "canDecreaseSeats": true,
            "canIncreaseSeats": true
        },
        "billing": {
            "cycle": 720,
            "term": 8640,
            "type": "my type"
        },
        "currency": "USD",
        "isEnabled": false,
        "marketplace": "US",
        "prices": {
            "buy": 12.34,
            "sell": 56.78,
            "public": 98.76
        },
        "saleConstraints": {
            "minQuantity": 12,
            "maxQuantity": 56
        },
        "identifiers": {
            "arrowsphere": {
                "sku": "IBM_5737A82_DK_MS_EMM_PRE_PROD_1M_USD_1_999"
            }
        }
    },
    "arrowSubCategories": [
        "nce"
    ]
}
JSON
            ],
        ];
    }
}
