<?php

namespace ArrowSphere\PublicApiClient\Tests\Licenses\Entities;

use ArrowSphere\PublicApiClient\Licenses\Entities\FilterFindResult;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

/**
 * Class FilterFindResultTest
 */
class FilterFindResultTest extends AbstractEntityTest
{
    protected const CLASS_NAME = FilterFindResult::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'name'   => 'my filter',
                    'values' => [
                        [
                            'value' => 'my value',
                            'count' => 12,
                        ],
                    ],
                ],
                'expected' => <<<JSON
{
    "name": "my filter",
    "values": [
        {
            "value": "my value",
            "count": 12
        }
    ]
}
JSON
            ],
        ];
    }
}
