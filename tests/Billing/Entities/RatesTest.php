<?php

namespace ArrowSphere\PublicApiClient\Tests\Billing\Entities;

use ArrowSphere\PublicApiClient\Billing\Entities\Rates;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class RatesTest extends AbstractEntityTest
{
    protected const CLASS_NAME = Rates::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'sellRate'     => 1.5,
                    'sellRateType' => 'uplift',
                ],
                'expected' => <<<JSON
{
    "sellRate": 1.5,
    "sellRateType": "uplift"
}
JSON
                ,
            ],
        ];
    }
}
