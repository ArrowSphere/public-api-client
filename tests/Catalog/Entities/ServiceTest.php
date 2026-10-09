<?php

namespace ArrowSphere\PublicApiClient\Tests\Catalog\Entities;

use ArrowSphere\PublicApiClient\Catalog\Entities\Service;
use PHPUnit\Framework\TestCase;

class ServiceTest extends TestCase
{
    /**
     */
    public function testServiceSerialisation(): void
    {
        $service = new Service([
            "reference"                     => "microsoft",
            "name"                          => "Microsoft",
            "associatedSubscriptionProgram" => "MSCSP",
            "logo"                          => "/index.php/site/img/type/vendor/ref/3",
            "category"                      => "SAAS",
            "description"                   => "description",
            "serviceTags"                   => ["Productivity"],
            "program"                       => "Microsoft"
        ]);

        self::assertEquals('{"associatedSubscriptionProgram":"MSCSP","category":"SAAS","description":"description","name":"Microsoft","program":"Microsoft","reference":"microsoft","serviceTags":["Productivity"]}', json_encode($service));
    }
}
