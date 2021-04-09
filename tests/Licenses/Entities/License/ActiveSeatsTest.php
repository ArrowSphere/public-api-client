<?php

namespace ArrowSphere\PublicApiClient\Tests\Licenses\Entities\License;

use ArrowSphere\PublicApiClient\Licenses\Entities\License\ActiveSeats;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

/**
 * Class ActiveSeatsTest
 */
class ActiveSeatsTest extends AbstractEntityTest
{
    protected const CLASS_NAME = ActiveSeats::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'lastUpdate' => '1955-11-05T21:13:35',
                    'number'     => 12,
                ],
                'expected' => <<<JSON
{
    "lastUpdate": "1955-11-05T21:13:35",
    "number": 12
}
JSON
            ],
        ];
    }
}
