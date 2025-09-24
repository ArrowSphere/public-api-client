<?php

namespace ArrowSphere\PublicApiClient\Tests\Orders;

use ArrowSphere\PublicApiClient\Orders\Entities\OrderHistory;
use ArrowSphere\PublicApiClient\Orders\OrdersClient;
use ArrowSphere\PublicApiClient\Orders\Request\CreateOrder;
use ArrowSphere\PublicApiClient\Orders\Request\OrdersFilters;
use ArrowSphere\PublicApiClient\Tests\AbstractClientTest;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\Constraint\IsAnything;

class OrdersClientTest extends AbstractClientTest
{
    protected const MOCKED_CLIENT_CLASS = OrdersClient::class;

    /**
     * @var OrdersClient
     */
    protected $client;

    public function testGetOrderHistory(): void
    {
        $expected = [
            'data' => [
                [
                    OrderHistory::COLUMN_ORDER_ID    => 'XSPO123',
                    OrderHistory::COLUMN_ACTION      => 'test',
                    OrderHistory::COLUMN_DESCRIPTION => 'test',
                    OrderHistory::COLUMN_USER        => 'admin',
                    OrderHistory::COLUMN_DATE_ACTION => '2024-07-18',
                ],
            ],
        ];
        $this->httpClient->expects(self::once())->method('request')->willReturn(new Response(200, [], json_encode($expected)));
        $response = $this->client->getOrderHistory('XSPO1234');
        self::assertCount(1, $response);
        $orderHistory = reset($response);
        self::assertArrayHasKey(OrderHistory::COLUMN_ORDER_ID, $orderHistory->jsonSerialize());
        self::assertEquals('XSPO123', $orderHistory->jsonSerialize()[OrderHistory::COLUMN_ORDER_ID]);
    }

    public function testValidateOrder(): void
    {
        $this->httpClient->expects(self::once())
            ->method('request')
            ->with('patch', 'https://www.test.com/orders/XSPO1234/validate', new IsAnything())->willReturn(new Response(200, [], 'ok'));
        $this->client->validateOrder('XSPO1234');
    }

    public function testCancelOrder(): void
    {
        $this->httpClient->expects(self::once())
            ->method('request')
            ->with('patch', 'https://www.test.com/orders/XSPO1234/cancel', new IsAnything())->willReturn(new Response(200, [], 'ok'));
        $this->client->cancelOrder('XSPO1234');
    }

    public function testResubmitOrder(): void
    {
        $this->httpClient->expects(self::once())
            ->method('request')
            ->with('patch', 'https://www.test.com/orders/XSPO1234/resubmit', new IsAnything())->willReturn(new Response(200, [], 'ok'));
        $this->client->resubmitOrder('XSPO1234');
    }

    public function testUpdateOrder(): void
    {
        $this->httpClient->expects(self::once())
            ->method('request')
            ->with('patch', 'https://www.test.com/orders/XSPO1234', new IsAnything())->willReturn(new Response(200, [], 'ok'));
        $this->client->updateOrder('XSPO1234', '123');
    }

    public function testGetOrder(): void
    {
        $expected = file_get_contents(__DIR__ . '/data/getOrder.json');

        $this->httpClient->expects(self::once())->method('request')->willReturn(new Response(200, [], $expected));
        $response = $this->client->getOrder('XSPO1234');
        self::assertEquals('XSPO1234', $response->getReference());
    }

    public function testGetOrders(): void
    {
        $expected = file_get_contents(__DIR__ . '/data/getOrders.json');

        $this->httpClient->expects(self::once())->method('request')->willReturn(new Response(200, [], $expected));
        $payload = [
            'reference' => 'XSPO1234',
            'status'    => 'open',
            'program'   => 'adobe',
        ];

        $order = new OrdersFilters($payload);
        $response = $this->client->getOrders($order);
        /** @var \ArrowSphere\PublicApiClient\Orders\Entities\Order[] $orderList */
        $orderList = iterator_to_array($response);
        self::assertEquals('XSPO1234', $orderList[0]->getReference());
    }

    public function testGetOrderPage(): void
    {
        $expected = file_get_contents(__DIR__ . '/data/getOrders.json');
        $this->httpClient->expects(self::once())->method('request')->willReturn(new Response(200, [], $expected));

        $payload = [
            'reference' => 'XSPO1234',
            'status'    => 'open',
            'program'   => 'adobe',
        ];

        $order = new OrdersFilters($payload);

        $response = $this->client->getOrdersPage($order, 1);
        $orderList = $response->getOrders();
        self::assertEquals('XSPO1234', $orderList[0]->getReference());
    }

    public function testCreateOrder(): void
    {
        $expected = [
            'data' => ['reference' => 'XSPO123'],
        ];
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

        $this->httpClient->expects(self::once())->method('request')
            ->with('post', 'https://www.test.com/orders', new IsAnything())
            ->willReturn(new Response(200, [], json_encode($expected)));

        self::assertEquals('XSPO123', $this->client->createOrder($order));
    }
}
