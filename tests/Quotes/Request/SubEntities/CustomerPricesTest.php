<?php

namespace ArrowSphere\PublicApiClient\Tests\Quotes\Request\SubEntities;

use ArrowSphere\PublicApiClient\Quotes\Request\SubEntities\CustomerPrices;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class CustomerPricesTest extends AbstractEntityTest
{
    protected const CLASS_NAME = CustomerPrices::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'rate'       => [
                        'rateType' => 'my rate type',
                        'value'    => 12.5,
                    ],
                    'fixedPrice' => 12.5,
                ],
                'expected' => <<<JSON
{
    "rate": {
        "rateType": "my rate type",
        "value": 12.5
    },
    "fixedPrice": 12.5
}
JSON
                ,
            ],
        ];
    }
}
