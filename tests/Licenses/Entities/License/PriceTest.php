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
                    'priceBandArrowsphereSku' => 'IBM_5737A82_DK_MS_EMM_PRE_PROD_1M_USD_1_999',
                    'buy_price'               => 12.34,
                    'sell_price'              => 45.67,
                    'list_price'              => 45.67,
                    'currency'                => 'USD',
                ],
                'expected' => <<<JSON
{
    "priceBandArrowsphereSku": "IBM_5737A82_DK_MS_EMM_PRE_PROD_1M_USD_1_999",
    "buy_price": 12.34,
    "sell_price": 45.67,
    "list_price": 45.67,
    "currency": "USD"
}
JSON
            ],
        ];
    }
}
