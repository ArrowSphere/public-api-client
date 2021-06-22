<?php

namespace ArrowSphere\PublicApiClient\Tests\Billing\Entities;

use ArrowSphere\PublicApiClient\Billing\Entities\Preference;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

/**
 * Class PreferenceTest
 */
class PreferenceTest extends AbstractEntityTest
{
    protected const CLASS_NAME = Preference::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields' => [
                    'name' => 'rule42',
                    'priority' => 1,
                    'identifier' => 'GroupBy',
                    'parameters' => [
                        'columns' => [
                            'ResourceGroup',
                        ],
                    ],
                    'filters' => [],
                    'overrides' => [
                        'ArsSku' => 'foobar',
                    ],
                ],
                'expected' => <<<JSON
{
    "name": "rule42",
    "priority": 1,
    "identifier": "GroupBy",
    "parameters": {
        "columns": [
            "ResourceGroup"
        ]
    },
    "filters": {},
    "overrides": {
        "ArsSku": "foobar"
    }
}
JSON
            ],
        ];
    }
}
