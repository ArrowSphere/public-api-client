<?php

namespace ArrowSphere\PublicApiClient\Tests\Licenses\Entities\License;

use ArrowSphere\PublicApiClient\Licenses\Entities\License\Price;
use ArrowSphere\PublicApiClient\Tests\AbstractQuantityEntityTest;

/**
 * Class PriceTest
 */
class PriceTest extends AbstractQuantityEntityTest
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
                'quantity' => 5,
                'expected' => <<<JSON
{
    "priceBandArrowsphereSku": "IBM_5737A82_DK_MS_EMM_PRE_PROD_1M_USD_1_999",
    "buy_price": 12.34,
    "sell_price": 45.67,
    "list_price": 45.67,
    "total_buy_price": 61.7,
    "total_sell_price": 228.35,
    "total_list_price": 228.35,
    "currency": "USD"
}
JSON
            ],
        ];
    }
}
