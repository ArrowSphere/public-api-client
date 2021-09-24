<?php

namespace ArrowSphere\PublicApiClient\Tests\Campaigns\Entities;

use ArrowSphere\PublicApiClient\Campaigns\Entities\Rules;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

/**
 * Class RulesTest
 */
class RulesTest extends AbstractEntityTest
{
    protected const CLASS_NAME = Rules::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    "locations"     => [
                        'my location 1',
                        'my location 2',
                    ],
                    "roles"         => [
                        'my role 1',
                        'my role 2',
                    ],
                    "marketplaces"  => [
                        'my marketplace 1',
                        'my marketplace 2',
                    ],
                    "subscriptions" => [
                        'my subscription 1',
                        'my subscription 2',
                    ],
                    "resellers"     => [
                        'my reseller 1',
                        'my reseller 2',
                    ],
                    "endCustomers"  => [
                        'my end customer 1',
                        'my end customer 2',
                    ],
                ],
                'expected' => <<<JSON
{
    "locations": [
        "my location 1",
        "my location 2"
    ],
    "roles": [
        "my role 1",
        "my role 2"
    ],
    "marketplaces": [
        "my marketplace 1",
        "my marketplace 2"
    ],
    "subscriptions": [
        "my subscription 1",
        "my subscription 2"
    ],
    "resellers": [
        "my reseller 1",
        "my reseller 2"
    ],
    "endCustomers": [
        "my end customer 1",
        "my end customer 2"
    ]
}
JSON
                ,
            ],
        ];
    }
}
