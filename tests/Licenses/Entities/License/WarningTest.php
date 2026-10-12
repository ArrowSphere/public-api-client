<?php

namespace ArrowSphere\PublicApiClient\Tests\Licenses\Entities\License;

use ArrowSphere\PublicApiClient\Licenses\Entities\License\Warning;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class WarningTest extends AbstractEntityTest
{
    protected const CLASS_NAME = Warning::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'key'     => 'my key',
                    'message' => 'my message',
                ],
                'expected' => <<<JSON
{
    "key": "my key",
    "message": "my message"
}
JSON
                ,
            ],
        ];
    }
}
