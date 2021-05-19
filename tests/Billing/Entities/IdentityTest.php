<?php

namespace ArrowSphere\PublicApiClient\Tests\Billing\Entities;

use ArrowSphere\PublicApiClient\Billing\Entities\Identity;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

/**
 * Class IdentityTest
 */
class IdentityTest extends AbstractEntityTest
{
    protected const CLASS_NAME = Identity::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields' => [
                    'reference' => 'XSP42',
                    'name' => 'Reseller',
                ],
                'expected' => <<<JSON
{
    "reference": "XSP42",
    "name": "Reseller"
}
JSON
            ],
        ];
    }
}
