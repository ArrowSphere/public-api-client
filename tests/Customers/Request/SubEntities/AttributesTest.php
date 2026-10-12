<?php

namespace ArrowSphere\PublicApiClient\Tests\Customers\Request\SubEntities;

use ArrowSphere\PublicApiClient\Customers\Request\SubEntities\Attributes;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class AttributesTest extends AbstractEntityTest
{
    protected const CLASS_NAME = Attributes::class;

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
