<?php

namespace ArrowSphere\PublicApiClient\Tests\Licenses\Entities\Offer\PriceBand;

use ArrowSphere\PublicApiClient\Licenses\Entities\Offer\PriceBand\Identifiers;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class IdentifiersTest extends AbstractEntityTest
{
    protected const CLASS_NAME = Identifiers::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'arrowsphere' => [
                        'sku' => 'my sku',
                    ],
                ],
                'expected' => <<<JSON
{
    "arrowsphere": {
        "sku": "my sku"
    }
}
JSON
                ,
            ],
        ];
    }
}
