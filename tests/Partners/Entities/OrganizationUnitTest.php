<?php

namespace ArrowSphere\PublicApiClient\Tests\Partners\Entities;

use ArrowSphere\PublicApiClient\Partners\Entities\OrganizationUnit;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class OrganizationUnitTest extends AbstractEntityTest
{
    protected const CLASS_NAME = OrganizationUnit::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'organizationUnitRef' => 'my organization unit ref',
                    'companyRef'          => 'my company ref',
                    'name'                => 'my name',
                ],
                'expected' => <<<JSON
{
    "organizationUnitRef": "my organization unit ref",
    "companyRef": "my company ref",
    "name": "my name"
}
JSON
                ,
            ],
        ];
    }
}
