<?php

namespace ArrowSphere\PublicApiClient\Tests\General\Entities;

use ArrowSphere\PublicApiClient\Exception\EntityValidationException;
use ArrowSphere\PublicApiClient\General\Entities\Whoami;
use PHPUnit\Framework\TestCase;

class WhoamiTest extends TestCase
{
    /**
     * @throws EntityValidationException
     */
    public function testWhoamiSerialisation(): void
    {
        $whoamI = new Whoami([
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
        ]);

        self::assertEquals('{"companyName":"Wayne industries","addressLine1":"1007 Mountain Drive","addressLine2":"Wayne Manor","zip":"12345","city":"Gotham City","countryCode":"US","state":"NJ","receptionPhone":"1-800-555-1111","websiteUrl":"https:\/\/www.dccomics.com","emailContact":"nobody@example.com","headcount":null,"taxNumber":"","reference":"XSP12345","ref":"COMPANY12345","billingId":"","internalReference":""}', json_encode($whoamI));
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
