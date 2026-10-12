<?php

namespace ArrowSphere\PublicApiClient\Tests\Customers\Entities;

use ArrowSphere\PublicApiClient\Customers\Entities\Attribute;
use ArrowSphere\PublicApiClient\Customers\Entities\ProvisionResponse;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class ProvisionResponseTest extends AbstractEntityTest
{
    protected const CLASS_NAME = ProvisionResponse::class;

    /**
     * @return array<string, array{array, string}>
     */
    public function providerSerialization(): array
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
     * @dataProvider providerSerialization
     */
    public function testGetterValues(array $data, string $expected): void
    {
        $response = new ProvisionResponse($data);

        self::assertSame($data['status'], $response->getStatus());
        self::assertContainsOnlyInstancesOf(Attribute::class, $response->getAttributes());
    }
}
