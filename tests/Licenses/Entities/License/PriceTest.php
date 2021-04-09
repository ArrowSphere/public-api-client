<?php

namespace ArrowSphere\PublicApiClient\Tests\Licenses\Entities\License;

use ArrowSphere\PublicApiClient\Licenses\Entities\License\Price;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

/**
 * Class PriceTest
 */
class PriceTest extends AbstractEntityTest
{
    protected const CLASS_NAME = Price::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'buy_price'  => 12.34,
                    'currency'   => 'USD',
                    'list_price' => 45.67,
                ],
                'expected' => <<<JSON
{
    "buy_price": 12.34,
    "currency": "USD",
    "list_price": 45.67
}
JSON
            ],
        ];
    }
}
