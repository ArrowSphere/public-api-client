<?php

namespace ArrowSphere\PublicApiClient\Tests\Quotes\Request\SubEntities;

use ArrowSphere\PublicApiClient\Quotes\Request\SubEntities\Prices;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class PricesTest extends AbstractEntityTest
{
    protected const CLASS_NAME = Prices::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
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
                'expected' => <<<JSON
{
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
}
JSON
                ,
            ],
        ];
    }
}
