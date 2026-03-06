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

    public function testWithScenario(): void
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
            'scenario' => 'default',
        ];

        $order = new CreateOrder($payload);

        self::assertEquals('default', $order->jsonSerialize()['scenario']);
    }

    public function testCreateOrderWithCustomFields(): void
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
            'customFields' => [
                [
                    'label' => 'Department',
                    'value' => 'IT',
                ],
                [
                    'label' => 'Project Code',
                    'value' => 'PRJ-2026-001',
                ],
                [
                    'label' => 'Cost Center',
                    'value' => 'CC-1234',
                ],
            ],
        ];

        $order = new CreateOrder($payload);

        self::assertArrayHasKey('customFields', $order->jsonSerialize());
        self::assertIsArray($order->jsonSerialize()['customFields']);
        self::assertCount(3, $order->jsonSerialize()['customFields']);
        self::assertEquals('Department', $order->jsonSerialize()['customFields'][0]['label']);
        self::assertEquals('IT', $order->jsonSerialize()['customFields'][0]['value']);
        self::assertEquals('Project Code', $order->jsonSerialize()['customFields'][1]['label']);
        self::assertEquals('PRJ-2026-001', $order->jsonSerialize()['customFields'][1]['value']);
        self::assertEquals('Cost Center', $order->jsonSerialize()['customFields'][2]['label']);
        self::assertEquals('CC-1234', $order->jsonSerialize()['customFields'][2]['value']);
    }
}
