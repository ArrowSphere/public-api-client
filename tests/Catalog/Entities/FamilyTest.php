<?php

namespace ArrowSphere\PublicApiClient\Tests\Catalog\Entities;

use ArrowSphere\PublicApiClient\Catalog\Entities\Family;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;
use PHPUnit\Framework\TestCase;

/**
 * Class FamilyTest
 */
class FamilyTest extends TestCase
{
    /**
     * @throws EntityValidationException
     */
    public function testSerialisation(): void
    {
        $family = new Family([
            'classification' => 'SAAS',
            "marketplace"    => 'US',
            'name'           => "family name",
            'reference'      => 'family reference',
            'vendor'         => 'the vendor',
            'vendorCode'     => 'the vendor code',
        ]);

        $expected = <<<JSON
{
    "classification": "SAAS",
    "marketplace": "US",
    "name": "family name",
    "reference": "family reference",
    "vendor": "the vendor",
    "vendorCode": "the vendor code"
}
JSON;

        self::assertEquals($expected, json_encode($family, JSON_PRETTY_PRINT));
    }
}
