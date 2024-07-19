<?php

namespace ArrowSphere\PublicApiClient\Tests\Orders\Request;

use ArrowSphere\PublicApiClient\Entities\Exception\EntitiesException;
use ArrowSphere\PublicApiClient\Orders\Request\CreateOrder;
use PHPUnit\Framework\TestCase;

class CreateOrderTest extends TestCase
{
    public function testCreateOrder(): void
    {
        $payload = [
            'customer' => [
                'reference' => 'test',
                'poNumber'  => 'test',
            ],
            'products' => [
                [
                    'quantity'                => 2,
                    'friendlyName'            => 'test',
                    'arrowSpherePriceBandSku' => 'testArrowsSku',
                ],
            ],
        ];

        $order = new CreateOrder($payload);

        self::assertEquals(2, $order->jsonSerialize()['products'][0]['quantity']);
        self::assertArrayNotHasKey('scheduledDate', $order->jsonSerialize());
    }

    public function testExceptionCreateOrderWithoutCustomer(): void
    {
        $payload = [
            'products' => [
                [
                    'quantity'                => 2,
                    'friendlyName'            => 'test',
                    'arrowSpherePriceBandSku' => 'testArrowsSku',
                ],
            ],
        ];
        self::expectException(EntitiesException::class);
        new CreateOrder($payload);
    }

    public function testExceptionCreateOrderWithoutProducts(): void
    {
        $payload = [
            'customer' => [
                'reference' => 'test',
                'poNumber'  => 'test',
            ],
        ];
        self::expectException(EntitiesException::class);
        new CreateOrder($payload);
    }

    public function testExceptionCreateOrderWithEmptyProducts(): void
    {
        $payload = [
            'customer' => [
                'reference' => 'test',
                'poNumber'  => 'test',
            ],
            'products' => [],
        ];
        self::expectException(EntitiesException::class);
        new CreateOrder($payload);
    }

    public function testExceptionCreateOrderWithEmptyCustomer(): void
    {
        $payload = [
            'customer' => [],
            'products' => [
                [
                    'quantity'                => 2,
                    'friendlyName'            => 'test',
                    'arrowSpherePriceBandSku' => 'testArrowsSku',
                ],
            ],
        ];
        self::expectException(EntitiesException::class);
        new CreateOrder($payload);
    }

    public function testExceptionCreateOrderWithEmptyCustomerReference(): void
    {
        $payload = [
            'customer' => [
                'reference' => null,
                'poNumber'  => 'test',
            ],
            'products' => [
                [
                    'quantity'                => 2,
                    'friendlyName'            => 'test',
                    'arrowSpherePriceBandSku' => 'testArrowsSku',
                ],
            ],
        ];
        self::expectException(EntitiesException::class);
        new CreateOrder($payload);
    }

    public function testCreateOrderWithExtraInformation(): void
    {
        $payload = [
            'customer'         => [
                'reference' => 'test',
                'poNumber'  => 'test',
            ],
            'products'         => [
                [
                    'quantity'                => 2,
                    'friendlyName'            => 'test',
                    'arrowSpherePriceBandSku' => 'testArrowsSku',
                ],
            ],
            'extraInformation' => [
                'programs' => [
                    'adobe' => ['order_comment' => '001'],
                ],
            ],
        ];

        $order = new CreateOrder($payload);

        self::assertArrayHasKey('adobe', $order->jsonSerialize()['extraInformation']['programs']);
        self::assertEquals('001', $order->jsonSerialize()['extraInformation']['programs']['adobe']['order_comment']);
    }

    public function testCreateOrderWithExtraInformationWithEmptyProgram(): void
    {
        $payload = [
            'customer'         => [
                'reference' => 'test',
                'poNumber'  => 'test',
            ],
            'products'         => [
                [
                    'quantity'                => 2,
                    'friendlyName'            => 'test',
                    'arrowSpherePriceBandSku' => 'testArrowsSku',
                ],
            ],
            'extraInformation' => [
                'programs' => [
                ],
            ],
        ];

        self::expectException(EntitiesException::class);
        new CreateOrder($payload);
    }
}
