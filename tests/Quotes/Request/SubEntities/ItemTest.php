<?php

namespace ArrowSphere\PublicApiClient\Tests\Quotes\Request\SubEntities;

use ArrowSphere\PublicApiClient\Quotes\Request\SubEntities\Item;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class ItemTest extends AbstractEntityTest
{
    protected const CLASS_NAME = Item::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'arrowSpherePriceBandSku' => 'my arrow sphere price band sku',
                    'quantity'                => 2,
                    'prices'                  => [
                        'arrow'    => [
                            'rate'       => [
                                'rateType' => 'my rate type',
                                'value'    => 12.5,
                            ],
                            'fixedPrice' => 12.5,
                        ],
                        'customer' => [
                            'rate'       => [
                                'rateType' => 'my rate type',
                                'value'    => 12.5,
                            ],
                            'fixedPrice' => 12.5,
                        ],
                        'partner'  => [
                            'rate'       => [
                                'rateType' => 'my rate type',
                                'value'    => 12.5,
                            ],
                            'fixedPrice' => 12.5,
                        ],
                    ],
                    'coterminosityDate'       => 'my coterminosity date',
                ],
                'expected' => <<<JSON
{
    "arrowSpherePriceBandSku": "my arrow sphere price band sku",
    "quantity": 2,
    "prices": {
        "arrow": {
            "rate": {
                "rateType": "my rate type",
                "value": 12.5
            },
            "fixedPrice": 12.5
        },
        "customer": {
            "rate": {
                "rateType": "my rate type",
                "value": 12.5
            },
            "fixedPrice": 12.5
        },
        "partner": {
            "rate": {
                "rateType": "my rate type",
                "value": 12.5
            },
            "fixedPrice": 12.5
        }
    },
    "coterminosityDate": "my coterminosity date"
}
JSON
                ,
            ],
        ];
    }
}
