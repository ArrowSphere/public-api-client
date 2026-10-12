<?php

namespace ArrowSphere\PublicApiClient\Tests\Quotes\Request;

use ArrowSphere\PublicApiClient\Quotes\Request\CreateQuote;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class CreateQuoteTest extends AbstractEntityTest
{
    protected const CLASS_NAME = CreateQuote::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'promotionCode' => 'my promotion code',
                    'customer'      => [
                        'reference' => 'my reference',
                    ],
                    'items'         => [
                        [
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
                    ],
                ],
                'expected' => <<<JSON
{
    "promotionCode": "my promotion code",
    "customer": {
        "reference": "my reference"
    },
    "items": [
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
    ]
}
JSON
                ,
            ],
        ];
    }
}
