<?php

namespace ArrowSphere\PublicApiClient\Tests\Catalog\Entities;

use ArrowSphere\PublicApiClient\Catalog\Entities\Family;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

/**
 * Class FamilyTest
 */
class FamilyTest extends AbstractEntityTest
{
    protected const CLASS_NAME = Family::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'classification' => 'SAAS',
                    "marketplace"    => 'US',
                    'name'           => "family name",
                    'reference'      => 'family reference',
                    'vendor'         => 'the vendor',
                    'vendorCode'     => 'the vendor code',
                ],
                'expected' => <<<JSON
{
    "classification": "SAAS",
    "marketplace": "US",
    "name": "family name",
    "reference": "family reference",
    "vendor": "the vendor",
    "vendorCode": "the vendor code"
}
JSON
                ,
            ],
        ];
    }
}
