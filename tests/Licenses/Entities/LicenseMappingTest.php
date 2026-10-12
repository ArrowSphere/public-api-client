<?php

namespace ArrowSphere\PublicApiClient\Tests\Licenses\Entities;

use ArrowSphere\PublicApiClient\Licenses\Entities\LicenseMapping;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class LicenseMappingTest extends AbstractEntityTest
{
    protected const CLASS_NAME = LicenseMapping::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'licenseMapping' => [
                        'key' => 'value',
                    ],
                ],
                'expected' => <<<JSON
{
    "licenseMapping": {
        "key": "value"
    }
}
JSON
                ,
            ],
        ];
    }
}
