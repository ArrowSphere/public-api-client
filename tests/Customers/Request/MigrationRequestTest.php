<?php

namespace ArrowSphere\PublicApiClient\Tests\Customers\Request;

use ArrowSphere\PublicApiClient\Customers\Request\MigrationRequest;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class MigrationRequestTest extends AbstractEntityTest
{
    protected const CLASS_NAME = MigrationRequest::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'program'    => 'my program',
                    'attributes' => [
                        [
                            'name'  => 'my name',
                            'value' => 'my value',
                        ],
                    ],
                ],
                'expected' => <<<JSON
{
    "program": "my program",
    "attributes": [
        {
            "name": "my name",
            "value": "my value"
        }
    ]
}
JSON
                ,
            ],
        ];
    }
}
