<?php

namespace ArrowSphere\PublicApiClient\Tests\OrganizationUnit\Entities;

use ArrowSphere\PublicApiClient\OrganizationUnit\Entities\OrganizationUnit;
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
                    'countUsers'          => 2,
                    'countCustomers'      => 2,
                    'countLicenses'       => 2,
                    'countOrders'         => 2,
                ],
                'expected' => <<<JSON
{
    "organizationUnitRef": "my organization unit ref",
    "companyRef": "my company ref",
    "name": "my name",
    "countUsers": 2,
    "countCustomers": 2,
    "countLicenses": 2,
    "countOrders": 2
}
JSON
                ,
            ],
        ];
    }
}
