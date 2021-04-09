<?php

namespace ArrowSphere\PublicApiClient\Tests\Licenses\Entities\License;

use ArrowSphere\PublicApiClient\Licenses\Entities\License\Config;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

/**
 * Class ConfigTest
 */
class ConfigTest extends AbstractEntityTest
{
    protected const CLASS_NAME = Config::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields' => [
                    'name' => 'purchaseReservations',
                    'scope' => 'role',
                    'state' => 'enabled',
                ],
                'expected' => <<<JSON
{
    "name": "purchaseReservations",
    "scope": "role",
    "state": "enabled"
}
JSON
            ],
        ];
    }
}
