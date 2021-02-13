<?php

namespace ArrowSphere\PublicApiClient\Tests\Customers\Entities;

use ArrowSphere\PublicApiClient\Customers\Entities\Contact;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;
use PHPUnit\Framework\TestCase;

/**
 * Class ContactTest
 */
class ContactTest extends TestCase
{
    /**
     * @throws EntityValidationException
     */
    public function testSerialize(): void
    {
        $contact = new Contact([
            'Email'     => 'test@example.com',
            'FirstName' => 'Bruce',
            'LastName'  => 'Wayne',
            'Phone'     => '1-800-555-1234',
        ]);

        $expected = <<<JSON
{
    "Email": "test@example.com",
    "FirstName": "Bruce",
    "LastName": "Wayne",
    "Phone": "1-800-555-1234"
}
JSON;

        self::assertSame($expected, json_encode($contact, JSON_PRETTY_PRINT));
    }
}
