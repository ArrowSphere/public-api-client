<?php

namespace ArrowSphere\PublicApiClient\Tests\Catalog\Entities;

use ArrowSphere\PublicApiClient\Catalog\Entities\FilterFindResult;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class FilterFindResultTest extends AbstractEntityTest
{
    protected const CLASS_NAME = FilterFindResult::class;

    /**
     * @return array<string, array{array, string}>
     */
    public function providerSerialization(): array
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
     * @dataProvider providerSerialization
     */
    public function testGetterValues(array $data, string $expected): void
    {
        $filter = new FilterFindResult($data);

        self::assertSame($data['name'], $filter->getName());
        self::assertSame($data['values'], $filter->getValues());
    }
}
