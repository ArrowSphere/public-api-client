<?php

namespace ArrowSphere\PublicApiClient\Tests\Billing\Entities;

use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

/**
 * Class IdentityTest
 */
class ErpExportColumnsTest extends AbstractEntityTest
{
    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields' => [
                    'column-reference1' => 'Friendly Name',
                    'column-reference2' => 'Vendor Name',
                ],
                'expected' => <<<JSON
{
    "column-reference1": "Friendly Name",
    "column-reference2": "Vendor Name"
}
JSON
            ],
        ];
    }
}
