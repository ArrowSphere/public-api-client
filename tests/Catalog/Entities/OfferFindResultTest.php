<?php

namespace ArrowSphere\PublicApiClient\Tests\Catalog\Entities;

use ArrowSphere\PublicApiClient\Catalog\Entities\OfferFindResult;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;
use PHPUnit\Framework\TestCase;

/**
 * Class OfferFindResultTest
 */
class OfferFindResultTest extends TestCase
{
    /**
     * @throws EntityValidationException
     */
    public function testSerialisation(): void
    {
        $offerFindResult = new OfferFindResult([
            'id'                => 'my id',
            'category'          => ['my category'],
            'customer_category' => 'my customer category',
            'has_addons'        => 'my has addons',
            'is_addon'          => 'my is addon',
            'add_ons'           => [],
            'prerequisites'     => [],
            'is_trial'          => 'my is trial',
            'keywords'          => ['my keywords'],
            'marketplace'       => 'my marketplace',
            'name'              => 'my name',
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
        ]);

        $expected = <<<JSON
{
    "add_ons": [],
    "category": [
        "my category"
    ],
    "customer_category": "my customer category",
    "has_addons": true,
    "is_addon": true,
    "is_trial": true,
    "keywords": [
        "my keywords"
    ],
    "marketplace": "my marketplace",
    "prerequisites": [],
    "name": "my name",
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
    ],
    "highlight": [],
    "id": "my id"
}
JSON;

        self::assertEquals($expected, json_encode($offerFindResult, JSON_PRETTY_PRINT));
    }
}
