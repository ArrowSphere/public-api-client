<?php

namespace ArrowSphere\PublicApiClient\Tests\Customers\Entities;

use ArrowSphere\PublicApiClient\Customers\Entities\Gdap;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

/**
 * Class GdapTest
 */
class GdapTest extends AbstractEntityTest
{
    protected const CLASS_NAME = Gdap::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields' => [
                    'id'             => '123',
                    'displayName'    => 'Gdap test',
                    'status'         => 'Pending Approval',
                    'startDate'      => '2024-01-01',
                    'endDate'        => '2024-06-30',
                    'duration'       => 'P180T',
                    'durationInDays' => '180',
                    'autoExtend'     => 'P180T',
                    'approvalLink'   => 'https://www.approval-link.com',
                    'privileges'     => [
                        [
                            "name" => "Directory Readers",
                            "description" => "Can read basic directory information. Commonly used to grant directory read access to applications and guests.",
                        ], [
                            "name" => "Directory Writers",
                            "description" => "Can read and write basic directory information. For granting access to applications, not intended for users.",
                        ],
                    ],
                    'securityGroups' => [
                        [
                            "name"   => "HelpdeskAgents",
                            "status" => "active",
                        ], [
                            "name" => "AdminAgents",
                            "status" => "active",
                        ],
                    ],
                ],
                'expected' => <<<JSON
{
    "id": "123",
    "displayName": "Gdap test",
    "status": "Pending Approval",
    "startDate": "2024-01-01",
    "endDate": "2024-06-30",
    "duration": "P180T",
    "durationInDays": "180",
    "autoExtend": "P180T",
    "approvalLink": "https:\/\/www.approval-link.com",
    "privileges": [
        {
            "name": "Directory Readers",
            "description": "Can read basic directory information. Commonly used to grant directory read access to applications and guests."
        },
        {
            "name": "Directory Writers",
            "description": "Can read and write basic directory information. For granting access to applications, not intended for users."
        }
    ],
    "securityGroups": [
        {
            "name": "HelpdeskAgents",
            "status": "active"
        },
        {
            "name": "AdminAgents",
            "status": "active"
        }
    ]
}
JSON
            ],
        ];
    }
}
