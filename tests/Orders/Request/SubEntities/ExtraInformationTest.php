<?php

namespace ArrowSphere\PublicApiClient\Tests\Orders\Request\SubEntities;

use ArrowSphere\PublicApiClient\Orders\Request\SubEntities\ExtraInformation;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class ExtraInformationTest extends AbstractEntityTest
{
    protected const CLASS_NAME = ExtraInformation::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'programs' => [
                        'my programs',
                    ],
                ],
                'expected' => <<<JSON
{
    "programs": [
        "my programs"
    ]
}
JSON
                ,
            ],
        ];
    }
}
