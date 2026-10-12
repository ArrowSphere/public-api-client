<?php

namespace ArrowSphere\PublicApiClient\Tests\Catalog\Entities;

use ArrowSphere\PublicApiClient\Catalog\Entities\Program;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class ProgramTest extends AbstractEntityTest
{
    protected const CLASS_NAME = Program::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    "reference"                     => "microsoft",
                    "name"                          => "Microsoft",
                    "associatedSubscriptionProgram" => "MSCSP",
                    "logo"                          => "/index.php/site/img/type/vendor/ref/3",
                    "category"                      => "SAAS"
                ],
                'expected' => <<<JSON
{
    "associatedSubscriptionProgram": "MSCSP",
    "category": "SAAS",
    "logo": "\/index.php\/site\/img\/type\/vendor\/ref\/3",
    "name": "Microsoft",
    "reference": "microsoft"
}
JSON
                ,
            ],
        ];
    }

    public function testProgramWithoutLogo(): void
    {
        $program = new Program([
            "reference"                     => "microsoft",
            "name"                          => "Microsoft",
            "associatedSubscriptionProgram" => "MSCSP",
            "logo"                          => null,
            "category"                      => "SAAS"
        ]);

        self::assertNull($program->getLogo());
        self::assertEquals('{"associatedSubscriptionProgram":"MSCSP","category":"SAAS","logo":null,"name":"Microsoft","reference":"microsoft"}', json_encode($program));
    }
}
