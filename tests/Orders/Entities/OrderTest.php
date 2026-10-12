<?php

namespace ArrowSphere\PublicApiClient\Tests\Orders\Entities;

use ArrowSphere\PublicApiClient\Orders\Entities\Order;
use ArrowSphere\PublicApiClient\Orders\Entities\OrdersProduct;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class OrderTest extends AbstractEntityTest
{
    protected const CLASS_NAME = Order::class;

    /**
     * Builds the orders of the client test fixtures, as is and without their optional fields.
     *
     * @return array<string, array{array, string}>
     */
    public function providerSerialization(): array
    {
        $expected = json_decode((string) file_get_contents(__DIR__ . '/../data/orderSerialization.json'), true);
        $cases = [];

        foreach (['getOrder', 'getOrders'] as $fixture) {
            $data = json_decode((string) file_get_contents(__DIR__ . "/../data/$fixture.json"), true);

            foreach ($data['data']['orders'] as $index => $order) {
                $cases["$fixture#$index"] = [$order, json_encode($expected["$fixture#$index"])];

                $variant = $order;
                unset($variant['extraInformation'], $variant['scheduledDate'], $variant['createdBy']);
                $variant['ponumber'] = null;
                foreach ($variant['products'] as &$product) {
                    unset($product['isAddon'], $product['isTrial'], $product['arrowSubCategories'], $product['detailedStatus']);
                    $product['license'] = null;
                }
                unset($product);

                $cases["$fixture#$index without optional fields"] = [$variant, json_encode($expected["$fixture#$index-variant"])];
            }
        }

        return $cases;
    }

    /**
     * @dataProvider providerSerialization
     */
    public function testProductsAreOrdersProducts(array $data, string $expected): void
    {
        self::assertContainsOnlyInstancesOf(OrdersProduct::class, (new Order($data))->getProducts());
    }

    public function testCreatorAndCommitmentFields(): void
    {
        $data = json_decode((string) file_get_contents(__DIR__ . '/../data/getOrder.json'), true)['data']['orders'][0];
        $order = new Order($data);

        self::assertSame($data['createdBy'], $order->getCreatedBy());
        self::assertSame((float) $data['commitmentAmountTotal'], $order->getCommitmentAmountTotal());
        self::assertSame($data['createdBy'], $order->jsonSerialize()['createdBy']);
        self::assertSame((float) $data['commitmentAmountTotal'], $order->jsonSerialize()['commitmentAmountTotal']);
    }

    public function testProductWithoutSubscription(): void
    {
        $data = json_decode((string) file_get_contents(__DIR__ . '/../data/getOrder.json'), true)['data']['orders'][0];
        unset($data['products'][0]['subscription']);
        $product = (new Order($data))->getProducts()[0];

        self::assertNull($product->getSubscription());
        self::assertArrayHasKey('subscription', $product->jsonSerialize());
        self::assertNull($product->jsonSerialize()['subscription']);
    }
}
