<?php

namespace ArrowSphere\PublicApiClient\Tests\Orders\Entities;

use ArrowSphere\PublicApiClient\Orders\Entities\Order;
use ArrowSphere\PublicApiClient\Orders\Entities\OrdersProduct;
use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{
    /**
     * Builds the orders of the client test fixtures, as is and without their optional fields.
     *
     * @return array<string, array{array, string}>
     */
    public static function serializationProvider(): array
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
     * @dataProvider serializationProvider
     */
    public function testSerialization(array $data, string $expected): void
    {
        $order = new Order($data);

        self::assertSame($expected, json_encode($order));
        self::assertContainsOnlyInstancesOf(OrdersProduct::class, $order->getProducts());
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
