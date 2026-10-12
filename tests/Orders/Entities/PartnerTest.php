<?php

namespace ArrowSphere\PublicApiClient\Tests\Orders\Entities;

use ArrowSphere\PublicApiClient\Orders\Entities\Partner;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class PartnerTest extends AbstractEntityTest
{
    protected const CLASS_NAME = Partner::class;

    public function providerSerialization(): array
    {
        return [
            'partner' => [
                'fields'   => ['companyName' => 'Wayne industries', 'contact' => ['email' => 'bruce@example.com', 'firstName' => 'Bruce', 'lastName' => 'Wayne']],
                'expected' => <<<JSON
{
    "companyName": "Wayne industries",
    "contact": {
        "email": "bruce@example.com",
        "firstName": "Bruce",
        "lastName": "Wayne"
    }
}
JSON
                ,
            ],
        ];
    }
}
