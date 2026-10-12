<?php

namespace ArrowSphere\PublicApiClient\Tests\Orders\Entities;

use ArrowSphere\PublicApiClient\Orders\Entities\ExtraInformation;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class ExtraInformationTest extends AbstractEntityTest
{
    protected const CLASS_NAME = ExtraInformation::class;

    public function providerSerialization(): array
    {
        return [
            'extra information' => [
                'fields'   => ['programs' => ['MSCSP' => ['domainName' => 'example.com']]],
                'expected' => <<<JSON
{
    "programs": {
        "MSCSP": {
            "domainName": "example.com"
        }
    }
}
JSON
                ,
            ],
        ];
    }
}
