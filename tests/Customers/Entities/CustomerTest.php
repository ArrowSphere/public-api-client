<?php

namespace ArrowSphere\PublicApiClient\Tests\Customers\Entities;

use ArrowSphere\PublicApiClient\Customers\Entities\Customer;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;
use PHPUnit\Framework\TestCase;

/**
 * Class CustomerTest
 */
class CustomerTest extends TestCase
{
    /**
     * @throws EntityValidationException
     */
    public function testSerialize(): void
    {
        $customer = new Customer([
            'AddressLine1'      => '1007 Mountain Drive',
            'AddressLine2'      => 'Wayne Manor',
            'BillingId'         => '',
            'City'              => 'Gotham City',
            'CompanyName'       => 'Wayne industries',
            'Contact'           => [
                'Email'     => 'test@example.com',
                'FirstName' => 'Bruce',
                'LastName'  => 'Wayne',
                'Phone'     => '1-800-555-1234',
            ],
            'CountryCode'       => 'US',
            'Details'           => [],
            'EmailContact'      => 'nobody@example.com',
            'Headcount'         => null,
            'InternalReference' => '',
            'ReceptionPhone'    => '1-800-555-1111',
            'Ref'               => 'COMPANY12345',
            'Reference'         => 'XSP12345',
            'State'             => 'NJ',
            'TaxNumber'         => '',
            'WebsiteUrl'        => 'https://www.dccomics.com',
            'Zip'               => '12345',
        ]);

        $expected = <<<JSON
{
    "AddressLine1": "1007 Mountain Drive",
    "AddressLine2": "Wayne Manor",
    "BillingId": "",
    "City": "Gotham City",
    "CompanyName": "Wayne industries",
    "Contact": {
        "Email": "test@example.com",
        "FirstName": "Bruce",
        "LastName": "Wayne",
        "Phone": "1-800-555-1234"
    },
    "CountryCode": "US",
    "Details": [],
    "DeletedAt": null,
    "EmailContact": "nobody@example.com",
    "Headcount": null,
    "InternalReference": "",
    "ReceptionPhone": "1-800-555-1111",
    "Ref": "COMPANY12345",
    "Reference": "XSP12345",
    "State": "NJ",
    "TaxNumber": "",
    "WebsiteUrl": "https:\/\/www.dccomics.com",
    "Zip": "12345"
}
JSON;

        self::assertSame($expected, json_encode($customer, JSON_PRETTY_PRINT));
    }
}
