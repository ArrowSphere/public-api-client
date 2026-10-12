<?php

namespace ArrowSphere\PublicApiClient\Tests\Licenses\Entities\License;

use ArrowSphere\PublicApiClient\Licenses\Entities\License\AwsPayerAccount;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class AwsPayerAccountTest extends AbstractEntityTest
{
    protected const CLASS_NAME = AwsPayerAccount::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'type'         => 'my type',
                    'friendlyName' => 'my friendly name',
                    'licenseRef'   => 'my license ref',
                ],
                'expected' => <<<JSON
{
    "type": "my type",
    "friendlyName": "my friendly name",
    "licenseRef": "my license ref"
}
JSON
                ,
            ],
        ];
    }
}
