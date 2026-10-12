<?php

namespace ArrowSphere\PublicApiClient\Tests\Catalog\Entities;

use ArrowSphere\PublicApiClient\Catalog\Entities\Service;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class ServiceTest extends AbstractEntityTest
{
    protected const CLASS_NAME = Service::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    "reference"                     => "microsoft",
                    "name"                          => "Microsoft",
                    "associatedSubscriptionProgram" => "MSCSP",
                    "logo"                          => "/index.php/site/img/type/vendor/ref/3",
                    "category"                      => "SAAS",
                    "description"                   => "description",
                    "serviceTags"                   => ["Productivity"],
                    "program"                       => "Microsoft"
                ],
                'expected' => <<<JSON
{
    "associatedSubscriptionProgram": "MSCSP",
    "category": "SAAS",
    "description": "description",
    "name": "Microsoft",
    "program": "Microsoft",
    "reference": "microsoft",
    "serviceTags": [
        "Productivity"
    ]
}
JSON
                ,
            ],
        ];
    }
}
