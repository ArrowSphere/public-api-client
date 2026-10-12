<?php

namespace ArrowSphere\PublicApiClient\Tests\Licenses\Entities\Offer\PriceBand\Identifiers;

use ArrowSphere\PublicApiClient\Licenses\Entities\Offer\PriceBand\Identifiers\Arrowsphere;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class ArrowsphereTest extends AbstractEntityTest
{
    protected const CLASS_NAME = Arrowsphere::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'sku' => 'my sku',
                ],
                'expected' => <<<JSON
{
    "sku": "my sku"
}
JSON
                ,
            ],
        ];
    }
}
