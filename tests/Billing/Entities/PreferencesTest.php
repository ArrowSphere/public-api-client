<?php

namespace ArrowSphere\PublicApiClient\Tests\Billing\Entities;

use ArrowSphere\PublicApiClient\Billing\Entities\Preferences;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

/**
 * Class PreferencesTest
 */
class PreferencesTest extends AbstractEntityTest
{
    protected const CLASS_NAME = Preferences::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields' => [
                    'preferences' => [
                        [
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
                        ]
                    ],
                    'validity' => [
                        'usable' => true,
                        'status' => 'OK',
                    ],
                ],
                'expected' => <<<JSON
{
    "preferences": [
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
    ],
    "validity": {
        "usable": true,
        "status": "OK"
    }
}
JSON
            ],
        ];
    }
}
