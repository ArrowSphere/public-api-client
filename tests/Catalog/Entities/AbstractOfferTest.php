<?php

namespace ArrowSphere\PublicApiClient\Tests\Catalog\Entities;

use ArrowSphere\PublicApiClient\Catalog\Entities\AbstractOffer;
use PHPUnit\Framework\TestCase;

/**
 * Class AbstractOfferTest
 */
class AbstractOfferTest extends TestCase
{
    public function testSerialisation(): void
    {
        $abstractOffer = $this->getMockForAbstractClass(
            AbstractOffer::class,
            [
                [
                    'category'          => ['my category'],
                    'customer_category' => 'my customer category',
                    'has_addons'        => false,
                    'is_addon'          => false,
                    'is_trial'          => false,
                    'keywords'          => ['my keyword'],
                    'marketplace'       => 'US',
                    'name'              => 'my offer name',
                    'add_ons'           => [],
                    'prerequisites'     => [],
                    'prices'            => [
                        [
                            'min_quantity'         => 0,
                            'max_quantity'         => 999,
                            'recurring_buy_price'  => 15,
                            'recurring_sell_price' => 20,
                            'term'                 => 'my term',
                            'unit_type'            => 'my unit type',
                            'recurring_time_unit'  => 'my recurring time unit',
                            'currency'             => 'my currency',
                            'period_as_hours'      => 12,
                            'term_as_hours'        => 123,
                        ],
                    ],
                    'service_name'      => 'my service name',
                    'service_ref'       => 'my service ref',
                    'sku'               => 'my sku',
                    'thumbnail'         => 'my thumbnail',
                    'type'              => 'my type',
                    'vendor'            => 'my vendor',
                    'vendor_code'       => 'my vendor code',
                    'weight_forced'     => 0.12,
                    'weight_top_sales'  => 0.48,
                ],
            ]
        );

        $expected = <<<JSON
{
    "add_ons": [],
    "category": [
        "my category"
    ],
    "customer_category": "my customer category",
    "has_addons": false,
    "is_addon": false,
    "is_trial": false,
    "keywords": [
        "my keyword"
    ],
    "marketplace": "US",
    "prerequisites": [],
    "name": "my offer name",
    "service_name": "my service name",
    "service_ref": "my service ref",
    "sku": "my sku",
    "thumbnail": "my thumbnail",
    "type": "my type",
    "vendor": "my vendor",
    "vendor_code": "my vendor code",
    "weight_forced": 0.12,
    "weight_top_sales": 0.48,
    "prices": [
        {
            "min_quantity": 0,
            "max_quantity": 999,
            "recurring_buy_price": 15,
            "recurring_sell_price": 20,
            "arrow_price": null,
            "term": "my term",
            "unit_type": "my unit type",
            "recurring_time_unit": "my recurring time unit",
            "currency": "my currency",
            "period_as_hours": 12,
            "term_as_hours": 123
        }
    ]
}
JSON;

        self::assertEquals($expected, json_encode($abstractOffer, JSON_PRETTY_PRINT));
    }
}
