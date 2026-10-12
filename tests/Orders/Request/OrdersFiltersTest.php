<?php

namespace ArrowSphere\PublicApiClient\Tests\Orders\Request;

use ArrowSphere\PublicApiClient\Orders\Request\OrdersFilters;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class OrdersFiltersTest extends AbstractEntityTest
{
    protected const CLASS_NAME = OrdersFilters::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'reference' => 'XSP123',
                    'status'    => 'open',
                    'program'   => 'adobe',
                ],
                'expected' => <<<JSON
{
    "reference": "XSP123",
    "status": "open",
    "program": "adobe"
}
JSON
                ,
            ],
        ];
    }
}
