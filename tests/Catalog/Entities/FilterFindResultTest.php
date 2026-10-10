<?php

namespace ArrowSphere\PublicApiClient\Tests\Catalog\Entities;

use ArrowSphere\PublicApiClient\Catalog\Entities\FilterFindResult;
use PHPUnit\Framework\TestCase;

class FilterFindResultTest extends TestCase
{
    /**
     * @return array<string, array{array, string}>
     */
    public static function serializationProvider(): array
    {
        return [
            'with values' => [
                ['name' => 'vendor', 'values' => [['value' => 'Microsoft', 'count' => 12]]],
                '{"name":"vendor","values":[{"value":"Microsoft","count":12}]}',
            ],
            'without values' => [
                ['name' => 'vendor', 'values' => []],
                '{"name":"vendor","values":[]}',
            ],
        ];
    }

    /**
     * @dataProvider serializationProvider
     */
    public function testSerialization(array $data, string $expected): void
    {
        $filter = new FilterFindResult($data);

        self::assertSame($expected, json_encode($filter));
        self::assertSame($data['name'], $filter->getName());
        self::assertSame($data['values'], $filter->getValues());
    }
}
