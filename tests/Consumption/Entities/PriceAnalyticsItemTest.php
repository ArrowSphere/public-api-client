<?php

namespace ArrowSphere\PublicApiClient\Tests\Consumption\Entities;

use ArrowSphere\PublicApiClient\Consumption\Entities\PriceAnalyticsItem;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class PriceAnalyticsItemTest extends AbstractEntityTest
{
    protected const CLASS_NAME = PriceAnalyticsItem::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    "arrowBuyPrice"       => 975550.55,
                    "resellerBuyPrice"    => 1025302.09,
                    "listBuyPrice"        => 1025302.09,
                    "endCustomerBuyPrice" => 123,
                    "currency"            => "USD"
                ],
                'expected' => <<<JSON
{
    "resellerBuyPrice": 1025302.09,
    "arrowBuyPrice": 975550.55,
    "listBuyPrice": 1025302.09,
    "endCustomerBuyPrice": 123,
    "currency": "USD"
}
JSON
                ,
            ],
        ];
    }

    public function testSerialisationWithoutOptionalPrices(): void
    {
        $price = new PriceAnalyticsItem([
            "resellerBuyPrice"    => 1025302.09,
            "listBuyPrice"        => 1025302.09,
            "endCustomerBuyPrice" => null,
            "currency"            => "USD"
        ]);

        self::assertNull($price->getArrowBuyPrice());
        self::assertNull($price->getEndCustomerBuyPrice());
        self::assertEquals('{"resellerBuyPrice":1025302.09,"arrowBuyPrice":null,"listBuyPrice":1025302.09,"endCustomerBuyPrice":null,"currency":"USD"}', json_encode($price));
    }
}
