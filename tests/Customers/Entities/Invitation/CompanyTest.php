<?php

namespace ArrowSphere\PublicApiClient\Tests\Customers\Entities\Invitation;

use ArrowSphere\PublicApiClient\Customers\Entities\Invitation\Company;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

/**
 * Class CompanyTest
 */
class CompanyTest extends AbstractEntityTest
{
    protected const CLASS_NAME = Company::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields' => [
                    'reference' => 'ABC12345',
                ],
                'expected' => <<<JSON
{
    "reference": "ABC12345"
}
JSON
            ],
        ];
    }
}
