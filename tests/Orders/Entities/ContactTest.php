<?php

namespace ArrowSphere\PublicApiClient\Tests\Orders\Entities;

use ArrowSphere\PublicApiClient\Orders\Entities\Contact;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class ContactTest extends AbstractEntityTest
{
    protected const CLASS_NAME = Contact::class;

    public function providerSerialization(): array
    {
        return [
            'contact' => [
                'fields'   => ['email' => 'bruce@example.com', 'firstName' => 'Bruce', 'lastName' => 'Wayne'],
                'expected' => <<<JSON
{
    "email": "bruce@example.com",
    "firstName": "Bruce",
    "lastName": "Wayne"
}
JSON
                ,
            ],
        ];
    }
}
