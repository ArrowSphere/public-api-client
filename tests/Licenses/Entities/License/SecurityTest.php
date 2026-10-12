<?php

namespace ArrowSphere\PublicApiClient\Tests\Licenses\Entities\License;

use ArrowSphere\PublicApiClient\Licenses\Entities\License\Security;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class SecurityTest extends AbstractEntityTest
{
    protected const CLASS_NAME = Security::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'activeFraudEvents' => 2,
                ],
                'expected' => <<<JSON
{
    "activeFraudEvents": 2
}
JSON
                ,
            ],
        ];
    }
}
