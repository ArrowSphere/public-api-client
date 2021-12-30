<?php

namespace ArrowSphere\PublicApiClient\Tests\Customers\Entities;

use ArrowSphere\PublicApiClient\Customers\Entities\Invitation;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

/**
 * Class InvitationTest
 */
class InvitationTest extends AbstractEntityTest
{
    protected const CLASS_NAME = Invitation::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields' => [
                    'code' => 'ABCD12345',
                    'createdAt' => '2021-12-25 23:59:51',
                    'updatedAt' => '2022-01-01 12:23:34',
                    'company' => [
                        'reference' => 'ABC123',
                    ],
                    'contact' => [
                        'username' => 'aaaabbbb-cccc-dddd-eeee-ffff00001111',
                        'email' => 'noreply@example.com',
                        'firstName' => 'Bruce',
                        'lastName' => 'Wayne',
                    ],
                ],
                'expected' => <<<JSON
{
    "code": "ABCD12345",
    "createdAt": "2021-12-25 23:59:51",
    "updatedAt": "2022-01-01 12:23:34",
    "contact": {
        "username": "aaaabbbb-cccc-dddd-eeee-ffff00001111",
        "email": "noreply@example.com",
        "firstName": "Bruce",
        "lastName": "Wayne"
    },
    "company": {
        "reference": "ABC123"
    }
}
JSON
            ],
        ];
    }
}
