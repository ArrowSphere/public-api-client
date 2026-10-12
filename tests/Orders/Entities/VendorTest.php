<?php

namespace ArrowSphere\PublicApiClient\Tests\Orders\Entities;

use ArrowSphere\PublicApiClient\Orders\Entities\Vendor;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class VendorTest extends AbstractEntityTest
{
    protected const CLASS_NAME = Vendor::class;

    public function providerSerialization(): array
    {
        return [
            'vendor' => [
                'fields'   => ['sku' => 'MS-0A-O365-BUSINESS'],
                'expected' => <<<JSON
{
    "sku": "MS-0A-O365-BUSINESS"
}
JSON
                ,
            ],
        ];
    }
}
