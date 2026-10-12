<?php

namespace ArrowSphere\PublicApiClient\Tests\Orders\Entities;

use ArrowSphere\PublicApiClient\Orders\Entities\Program;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class ProgramTest extends AbstractEntityTest
{
    protected const CLASS_NAME = Program::class;

    public function providerSerialization(): array
    {
        return [
            'program' => [
                'fields'   => ['legacyCode' => 'microsoft'],
                'expected' => <<<JSON
{
    "legacyCode": "microsoft"
}
JSON
                ,
            ],
        ];
    }
}
