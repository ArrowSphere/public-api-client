<?php

namespace ArrowSphere\PublicApiClient\Tests\Orders\Entities;

use ArrowSphere\PublicApiClient\Orders\Entities\Reference;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class ReferenceTest extends AbstractEntityTest
{
    protected const CLASS_NAME = Reference::class;

    public function providerSerialization(): array
    {
        return [
            'reference' => [
                'fields'   => ['reference' => 'XSP12345'],
                'expected' => <<<JSON
{
    "reference": "XSP12345"
}
JSON
                ,
            ],
        ];
    }
}
