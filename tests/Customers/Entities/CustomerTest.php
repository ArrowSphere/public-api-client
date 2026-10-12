<?php

namespace ArrowSphere\PublicApiClient\Tests\Customers\Entities;

use ArrowSphere\PublicApiClient\Customers\Entities\Customer;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

/**
 * Class CustomerTest
 */
class CustomerTest extends AbstractEntityTest
{
    protected const CLASS_NAME = Customer::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
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
                ],
                'expected' => <<<JSON
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
    "Zip": "12345",
    "OrganizationUnit": null
}
JSON
                ,
            ],
        ];
    }

    public function testSerializeWithDefaults(): void
    {
        $customer = new Customer([
            'AddressLine1'      => null,
            'City'              => 'Gotham City',
            'CompanyName'       => 'Wayne industries',
            'Contact'           => [
                'Email'     => 'test@example.com',
                'FirstName' => 'Bruce',
                'LastName'  => 'Wayne',
                'Phone'     => '',
            ],
            'CountryCode'       => 'US',
            'Details'           => [],
            'EmailContact'      => 'nobody@example.com',
            'Headcount'         => null,
            'InternalReference' => '',
            'ReceptionPhone'    => '',
            'Ref'               => '',
            'State'             => '',
            'TaxNumber'         => '',
            'Zip'               => '',
        ]);

        self::assertSame('', $customer->getAddressLine1());
        self::assertSame('', $customer->getBillingId());
        self::assertNull($customer->getReference());
        self::assertNull($customer->getOrganizationUnit());
        self::assertSame('{"AddressLine1":"","AddressLine2":"","BillingId":"","City":"Gotham City","CompanyName":"Wayne industries","Contact":{"Email":"test@example.com","FirstName":"Bruce","LastName":"Wayne","Phone":""},"CountryCode":"US","Details":[],"DeletedAt":null,"EmailContact":"nobody@example.com","Headcount":null,"InternalReference":"","ReceptionPhone":"","Ref":"","Reference":null,"State":"","TaxNumber":"","WebsiteUrl":null,"Zip":"","OrganizationUnit":null}', json_encode($customer));
    }
}
