<?php

namespace ArrowSphere\PublicApiClient\Tests\Consumption\Entities;

use ArrowSphere\PublicApiClient\Consumption\Entities\HealthCheckItem;
use PHPUnit\Framework\TestCase;

class HealthCheckItemTest extends TestCase
{
    /**
     */
    public function testHealthCheckItemSerialisation(): void
    {
        $healthcheckItem = new HealthCheckItem([
            "vendor"         => "Microsoft",
            "marketplace"    => "FR",
            "classification" => "SAAS",
            "color"          => "green",
            "message"        => "OK"
        ]);

        self::assertEquals('{"vendor":"Microsoft","marketplace":"FR","classification":"SAAS","color":"green","message":"OK"}', json_encode($healthcheckItem));
    }
}
