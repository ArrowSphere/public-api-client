<?php

namespace ArrowSphere\PublicApiClient\Tests\Consumption\Entities;

use ArrowSphere\PublicApiClient\Consumption\Entities\MonthlyAnalyticsItem;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;
use PHPUnit\Framework\TestCase;

class MonthlyAnalyticsItemTest extends TestCase
{
    /**
     * @throws EntityValidationException
     */
    public function testHealthCheckItemSerialisation(): void
    {
        $monthlyItem = new MonthlyAnalyticsItem([
            "month"          => '2020-05',
            "vendor"         => "Microsoft",
            "marketplace"    => "FR",
            "classification" => "SAAS",
            "tag"            => null,
            "usdPrice"       => [
                "arrowBuyPrice"       => 975550.55,
                "resellerBuyPrice"    => 1025302.09,
                "endCustomerBuyPrice" => null,
                "listBuyPrice"        => 10.95,
                "currency"            => "USD"
            ],
            "localPrice"     => [
                "arrowBuyPrice"       => 838778.34,
                "resellerBuyPrice"    => 881554.72,
                "endCustomerBuyPrice" => 9.32,
                "listBuyPrice"        => 0,
                "currency"            => "EUR"
            ]
        ]);

        self::assertEquals('{"vendor":"Microsoft","marketplace":"FR","classification":"SAAS","tag":null,"month":"2020-05","localPrice":{"resellerBuyPrice":881554.72,"arrowBuyPrice":838778.34,"listBuyPrice":0,"endCustomerBuyPrice":9.32,"currency":"EUR"},"usdPrice":{"resellerBuyPrice":1025302.09,"arrowBuyPrice":975550.55,"listBuyPrice":10.95,"endCustomerBuyPrice":null,"currency":"USD"}}', json_encode($monthlyItem));
    }
}
