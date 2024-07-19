<?php

namespace ArrowSphere\PublicApiClient\Tests\Orders\Request;

use ArrowSphere\PublicApiClient\Orders\Request\OrdersFilters;
use PHPUnit\Framework\TestCase;

class OrdersFiltersTest extends TestCase
{
    public function testCreateOrder(): void
    {
        $payload = [
            'reference' => 'XSP123',
            'status' => 'open',
            'program' => 'adobe',
        ];
        $price = new OrdersFilters($payload);

        self::assertEquals('XSP123', $price->jsonSerialize()['reference']);
        self::assertEquals('open', $price->jsonSerialize()['status']);
        self::assertEquals('adobe', $price->jsonSerialize()['program']);
    }
}
