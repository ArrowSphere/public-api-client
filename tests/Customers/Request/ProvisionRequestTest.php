<?php

namespace ArrowSphere\PublicApiClient\Tests\Customers\Request;

use ArrowSphere\PublicApiClient\Customers\Request\ProvisionRequest;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class ProvisionRequestTest extends AbstractEntityTest
{
    protected const CLASS_NAME = ProvisionRequest::class;

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
