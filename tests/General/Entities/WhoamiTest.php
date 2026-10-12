<?php

namespace ArrowSphere\PublicApiClient\Tests\General\Entities;

use ArrowSphere\PublicApiClient\General\Entities\Whoami;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class WhoamiTest extends AbstractEntityTest
{
    protected const CLASS_NAME = Whoami::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    "companyName"       => "Wayne industries",
                    "addressLine1"      => "1007 Mountain Drive",
                    "addressLine2"      => "Wayne Manor",
                    "zip"               => "12345",
                    "city"              => "Gotham City",
                    "countryCode"       => "US",
                    "state"             => "NJ",
                    "receptionPhone"    => "1-800-555-1111",
                    "websiteUrl"        => "https://www.dccomics.com",
                    "emailContact"      => "nobody@example.com",
                    "headcount"         => null,
                    "taxNumber"         => "",
                    "reference"         => "XSP12345",
                    "ref"               => "COMPANY12345",
                    "billingId"         => "",
                    "internalReference" => ""
                ],
                'expected' => <<<JSON
{
    "companyName": "Wayne industries",
    "addressLine1": "1007 Mountain Drive",
    "addressLine2": "Wayne Manor",
    "zip": "12345",
    "city": "Gotham City",
    "countryCode": "US",
    "state": "NJ",
    "receptionPhone": "1-800-555-1111",
    "websiteUrl": "https:\/\/www.dccomics.com",
    "emailContact": "nobody@example.com",
    "headcount": null,
    "taxNumber": "",
    "reference": "XSP12345",
    "ref": "COMPANY12345",
    "billingId": "",
    "internalReference": ""
}
JSON
                ,
            ],
        ];
    }

    public function testWhoamiWithoutAddressLines(): void
    {
        $whoami = new Whoami([
            "companyName"       => "Wayne industries",
            "addressLine1"      => null,
            "addressLine2"      => null,
            "zip"               => "12345",
            "city"              => "Gotham City",
            "countryCode"       => "US",
            "state"             => "NJ",
            "receptionPhone"    => "",
            "websiteUrl"        => "",
            "emailContact"      => "nobody@example.com",
            "headcount"         => null,
            "taxNumber"         => "",
            "reference"         => "XSP12345",
            "ref"               => "",
            "billingId"         => "",
            "internalReference" => ""
        ]);

        self::assertNull($whoami->getAddressLine1());
        self::assertNull($whoami->getAddressLine2());
        self::assertSame('{"companyName":"Wayne industries","addressLine1":null,"addressLine2":null,"zip":"12345","city":"Gotham City","countryCode":"US","state":"NJ","receptionPhone":"","websiteUrl":"","emailContact":"nobody@example.com","headcount":null,"taxNumber":"","reference":"XSP12345","ref":"","billingId":"","internalReference":""}', json_encode($whoami));
    }
}
