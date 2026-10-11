<?php

namespace ArrowSphere\PublicApiClient\Tests\Customers\Entities;

use ArrowSphere\PublicApiClient\Customers\Entities\Attribute;
use ArrowSphere\PublicApiClient\Customers\Entities\ProvisionResponse;
use PHPUnit\Framework\TestCase;

class ProvisionResponseTest extends TestCase
{
    /**
     * @return array<string, array{array, string}>
     */
    public static function serializationProvider(): array
    {
        return [
            'with attributes'    => [
                ['status' => 'SUCCESS', 'message' => 'Done', 'attributes' => [['name' => 'tenantId', 'value' => 'abc']]],
                '{"status":"SUCCESS","message":"Done","attributes":[{"name":"tenantId","value":"abc"}]}',
            ],
            'without attributes' => [
                ['status' => 'PENDING', 'message' => '', 'attributes' => []],
                '{"status":"PENDING","message":"","attributes":[]}',
            ],
        ];
    }

    /**
     * @dataProvider serializationProvider
     */
    public function testSerialization(array $data, string $expected): void
    {
        $response = new ProvisionResponse($data);

        self::assertSame($expected, json_encode($response));
        self::assertSame($data['status'], $response->getStatus());
        self::assertContainsOnlyInstancesOf(Attribute::class, $response->getAttributes());
    }
}
