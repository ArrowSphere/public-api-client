<?php

namespace ArrowSphere\PublicApiClient\Tests\Orders\Entities;

use ArrowSphere\PublicApiClient\Orders\Entities\OrderHistory;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class OrderHistoryTest extends AbstractEntityTest
{
    protected const CLASS_NAME = OrderHistory::class;

    public function providerSerialization(): array
    {
        return [
            'order history' => [
                'fields'   => ['orderId' => 'XSP123', 'action' => 'CREATE', 'description' => 'Order created', 'user' => 'Bruce Wayne', 'dateAction' => '2026-01-01 10:00:00'],
                'expected' => <<<JSON
{
    "orderId": "XSP123",
    "action": "CREATE",
    "description": "Order created",
    "user": "Bruce Wayne",
    "dateAction": "2026-01-01 10:00:00"
}
JSON
                ,
            ],
            'order history defaults' => [
                'fields'   => ['orderId' => 'XSP123', 'action' => null],
                'expected' => <<<JSON
{
    "orderId": "XSP123",
    "action": "",
    "description": "",
    "user": "",
    "dateAction": ""
}
JSON
                ,
            ],
        ];
    }
}
