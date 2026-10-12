<?php

namespace ArrowSphere\PublicApiClient\Tests\Billing\Entities;

use ArrowSphere\PublicApiClient\Billing\Entities\ErpExportType;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class ErpExportTypeTest extends AbstractEntityTest
{
    protected const CLASS_NAME = ErpExportType::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'name'    => 'my name',
                    'columns' => [
                        'key' => 'value',
                    ],
                ],
                'expected' => <<<JSON
{
    "name": "my name",
    "columns": {
        "key": "value"
    }
}
JSON
                ,
            ],
        ];
    }
}
