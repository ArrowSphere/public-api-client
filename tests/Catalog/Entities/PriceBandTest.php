<?php

namespace ArrowSphere\PublicApiClient\Tests\Catalog\Entities;

use ArrowSphere\PublicApiClient\Catalog\Entities\PriceBand;
use PHPUnit\Framework\TestCase;

class PriceBandTest extends TestCase
{
    /**
     * @return array<string, array{array, string}>
     */
    public static function serializationProvider(): array
    {
        $data = [
            'min_quantity'         => 1,
            'max_quantity'         => 100,
            'recurring_buy_price'  => 10.5,
            'recurring_sell_price' => 12.6,
            'arrow_price'          => 9.5,
            'term'                 => 'P1Y',
            'unit_type'            => 'LICENSE',
            'recurring_time_unit'  => 'MONTH',
            'currency'             => 'USD',
            'period_as_hours'      => 720,
            'term_as_hours'        => 8640,
        ];

        return [
            'every field' => [
                $data,
                '{"min_quantity":1,"max_quantity":100,"recurring_buy_price":10.5,"recurring_sell_price":12.6,"arrow_price":9.5,"term":"P1Y","unit_type":"LICENSE","recurring_time_unit":"MONTH","currency":"USD","period_as_hours":720,"term_as_hours":8640}',
            ],
            'infinite maximum quantity and no arrow price' => [
                array_diff_key(array_merge($data, ['max_quantity' => 'Infinity']), ['arrow_price' => true]),
                '{"min_quantity":1,"max_quantity":null,"recurring_buy_price":10.5,"recurring_sell_price":12.6,"arrow_price":null,"term":"P1Y","unit_type":"LICENSE","recurring_time_unit":"MONTH","currency":"USD","period_as_hours":720,"term_as_hours":8640}',
            ],
        ];
    }

    /**
     * @dataProvider serializationProvider
     */
    public function testSerialization(array $data, string $expected): void
    {
        $priceBand = new PriceBand($data);

        self::assertSame($expected, json_encode($priceBand));
        self::assertSame($data['min_quantity'], $priceBand->getMinQuantity());
        self::assertSame($data['currency'], $priceBand->getCurrency());
    }
}
