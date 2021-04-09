<?php

namespace ArrowSphere\PublicApiClient\Tests\Licenses\Entities\Offer\PriceBand;

use ArrowSphere\PublicApiClient\Licenses\Entities\Offer\PriceBand\Prices;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

/**
 * Class PricesTest
 */
class PricesTest extends AbstractEntityTest
{
    protected const CLASS_NAME = Prices::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'buy'    => 12.34,
                    'sell'   => 56.78,
                    'public' => 98.76,
                ],
                'expected' => <<<JSON
{
    "buy": 12.34,
    "sell": 56.78,
    "public": 98.76
}
JSON
            ],
        ];
    }
}
