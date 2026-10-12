<?php

namespace ArrowSphere\PublicApiClient\Tests\Quotes\Request\SubEntities;

use ArrowSphere\PublicApiClient\Quotes\Request\SubEntities\Rate;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class RateTest extends AbstractEntityTest
{
    protected const CLASS_NAME = Rate::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'rateType' => 'my rate type',
                    'value'    => 12.5,
                ],
                'expected' => <<<JSON
{
    "rateType": "my rate type",
    "value": 12.5
}
JSON
                ,
            ],
        ];
    }
}
