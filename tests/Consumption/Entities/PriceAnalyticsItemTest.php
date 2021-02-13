<?php

namespace ArrowSphere\PublicApiClient\Tests\Consumption\Entities;

use ArrowSphere\PublicApiClient\Consumption\Entities\PriceAnalyticsItem;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;
use PHPUnit\Framework\TestCase;

class PriceAnalyticsItemTest extends TestCase
{
    /**
     * @throws EntityValidationException
     */
    public function testHealthCheckItemSerialisation(): void
    {
        $price = new PriceAnalyticsItem([
            "arrowBuyPrice"       => 975550.55,
            "resellerBuyPrice"    => 1025302.09,
            "listBuyPrice"        => 1025302.09,
            "endCustomerBuyPrice" => 123,
            "currency"            => "USD"
        ]);

        self::assertEquals('{"resellerBuyPrice":1025302.09,"arrowBuyPrice":975550.55,"listBuyPrice":1025302.09,"endCustomerBuyPrice":123,"currency":"USD"}', json_encode($price));
    }
}
