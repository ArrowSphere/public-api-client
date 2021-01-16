<?php

namespace ArrowSphere\PublicApiClient\Tests\Catalog\Entities;

use ArrowSphere\PublicApiClient\Catalog\Entities\Program;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;
use PHPUnit\Framework\TestCase;

class ProgramTest extends TestCase
{
    /**
     * @throws EntityValidationException
     */
    public function testProgramSerialisation(): void
    {
        $program = new Program([
            "reference"                     => "microsoft",
            "name"                          => "Microsoft",
            "associatedSubscriptionProgram" => "MSCSP",
            "logo"                          => "/index.php/site/img/type/vendor/ref/3",
            "category"                      => "SAAS"
        ]);

        self::assertEquals('{"associatedSubscriptionProgram":"MSCSP","category":"SAAS","logo":"\/index.php\/site\/img\/type\/vendor\/ref\/3","name":"Microsoft","reference":"microsoft"}', json_encode($program));
    }
}