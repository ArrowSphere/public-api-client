<?php

namespace ArrowSphere\PublicApiClient\Tests\Contacts\Entities;

use ArrowSphere\PublicApiClient\Contacts\Entities\VendorContact;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class VendorContactTest extends AbstractEntityTest
{
    protected const CLASS_NAME = VendorContact::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'firstname' => 'my firstname',
                    'lastname'  => 'my lastname',
                    'email'     => 'my email',
                    'phone'     => 'my phone',
                ],
                'expected' => <<<JSON
{
    "firstname": "my firstname",
    "lastname": "my lastname",
    "email": "my email",
    "phone": "my phone"
}
JSON
                ,
            ],
        ];
    }
}
