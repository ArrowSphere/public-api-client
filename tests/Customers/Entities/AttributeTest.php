<?php

namespace ArrowSphere\PublicApiClient\Tests\Customers\Entities;

use ArrowSphere\PublicApiClient\Customers\Entities\Attribute;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class AttributeTest extends AbstractEntityTest
{
    protected const CLASS_NAME = Attribute::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'name'  => 'my name',
                    'value' => 'my value',
                ],
                'expected' => <<<JSON
{
    "name": "my name",
    "value": "my value"
}
JSON
                ,
            ],
        ];
    }
}
