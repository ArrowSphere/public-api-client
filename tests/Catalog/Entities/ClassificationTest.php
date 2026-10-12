<?php

namespace ArrowSphere\PublicApiClient\Tests\Catalog\Entities;

use ArrowSphere\PublicApiClient\Catalog\Entities\Classification;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class ClassificationTest extends AbstractEntityTest
{
    protected const CLASS_NAME = Classification::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    "name" => "Microsoft",
                ],
                'expected' => <<<JSON
"Microsoft"
JSON
                ,
            ],
        ];
    }
}
