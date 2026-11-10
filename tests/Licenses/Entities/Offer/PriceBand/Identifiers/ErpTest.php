<?php

namespace ArrowSphere\PublicApiClient\Tests\Licenses\Entities\Offer\PriceBand\Identifiers;

use ArrowSphere\PublicApiClient\Licenses\Entities\Offer\PriceBand\Identifiers\Erp;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class ErpTest extends AbstractEntityTest
{
    protected const CLASS_NAME = Erp::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'sku' => 'my erp sku',
                ],
                'expected' => <<<JSON
{
    "sku": "my erp sku"
}
JSON
                ,
            ],
        ];
    }
}
