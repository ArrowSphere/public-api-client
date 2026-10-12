<?php

namespace ArrowSphere\PublicApiClient\Tests\Consumption\Entities;

use ArrowSphere\PublicApiClient\Consumption\Entities\HealthCheckItem;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class HealthCheckItemTest extends AbstractEntityTest
{
    protected const CLASS_NAME = HealthCheckItem::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    "vendor"         => "Microsoft",
                    "marketplace"    => "FR",
                    "classification" => "SAAS",
                    "color"          => "green",
                    "message"        => "OK"
                ],
                'expected' => <<<JSON
{
    "vendor": "Microsoft",
    "marketplace": "FR",
    "classification": "SAAS",
    "color": "green",
    "message": "OK"
}
JSON
                ,
            ],
        ];
    }
}
