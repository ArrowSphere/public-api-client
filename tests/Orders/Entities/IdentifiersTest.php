<?php

namespace ArrowSphere\PublicApiClient\Tests\Orders\Entities;

use ArrowSphere\PublicApiClient\Orders\Entities\Identifiers;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class IdentifiersTest extends AbstractEntityTest
{
    protected const CLASS_NAME = Identifiers::class;

    public function providerSerialization(): array
    {
        return [
            'identifiers' => [
                'fields'   => ['vendor' => ['sku' => 'MS-0A-O365-BUSINESS']],
                'expected' => <<<JSON
{
    "vendor": {
        "sku": "MS-0A-O365-BUSINESS"
    }
}
JSON
                ,
            ],
        ];
    }
}
