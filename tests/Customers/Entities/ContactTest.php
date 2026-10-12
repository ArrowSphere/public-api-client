<?php

namespace ArrowSphere\PublicApiClient\Tests\Customers\Entities;

use ArrowSphere\PublicApiClient\Customers\Entities\Contact;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

/**
 * Class ContactTest
 */
class ContactTest extends AbstractEntityTest
{
    protected const CLASS_NAME = Contact::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'Email'     => 'test@example.com',
                    'FirstName' => 'Bruce',
                    'LastName'  => 'Wayne',
                    'Phone'     => '1-800-555-1234',
                ],
                'expected' => <<<JSON
{
    "Email": "test@example.com",
    "FirstName": "Bruce",
    "LastName": "Wayne",
    "Phone": "1-800-555-1234"
}
JSON
                ,
            ],
        ];
    }
}
