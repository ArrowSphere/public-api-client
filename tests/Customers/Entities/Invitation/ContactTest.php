<?php

namespace ArrowSphere\PublicApiClient\Tests\Customers\Entities\Invitation;

use ArrowSphere\PublicApiClient\Customers\Entities\Invitation\Contact;
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
                'fields' => [
                    'username' => 'aaaabbbb-cccc-dddd-eeee-ffff00001111',
                    'email' => 'noreply@example.com',
                    'firstName' => 'Bruce',
                    'lastName' => 'Wayne',
                ],
                'expected' => <<<JSON
{
    "username": "aaaabbbb-cccc-dddd-eeee-ffff00001111",
    "email": "noreply@example.com",
    "firstName": "Bruce",
    "lastName": "Wayne"
}
JSON
            ],
        ];
    }
}
