<?php

namespace ArrowSphere\PublicApiClient\Tests\Partners\Entities;

use ArrowSphere\PublicApiClient\Partners\Entities\OrganizationUnitsResponse;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class OrganizationUnitsResponseTest extends AbstractEntityTest
{
    protected const CLASS_NAME = OrganizationUnitsResponse::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'data'       => [
                        [
                            'organizationUnitRef' => 'XSPOU1',
                            'companyRef'          => 'XSP1',
                            'name'                => 'My unit',
                            'countUsers'          => 2,
                            'countCustomers'      => 3,
                        ],
                    ],
                    'pagination' => [
                        'per_page'     => 10,
                        'current_page' => 1,
                        'total_page'   => 1,
                        'total'        => 1,
                        'next'         => '',
                        'previous'     => '',
                    ],
                ],
                'expected' => <<<JSON
{
    "organizationUnits": [
        {
            "organizationUnitRef": "XSPOU1",
            "companyRef": "XSP1",
            "name": "My unit"
        }
    ],
    "pagination": {
        "per_page": 10,
        "current_page": 1,
        "total_page": 1,
        "total": 1,
        "next": "",
        "previous": ""
    }
}
JSON
                ,
            ],
        ];
    }
}
