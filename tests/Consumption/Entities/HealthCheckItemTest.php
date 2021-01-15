<?php

namespace ArrowSphere\PublicApiClient\Tests\Consumption\Entities;

use ArrowSphere\PublicApiClient\Consumption\Entities\HealthCheckItem;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;
use PHPUnit\Framework\TestCase;
use ReflectionException;

class HealthCheckItemTest extends TestCase
{
    /**
     * @throws EntityValidationException|ReflectionException
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