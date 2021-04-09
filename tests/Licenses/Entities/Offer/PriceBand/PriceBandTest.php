<?php

namespace ArrowSphere\PublicApiClient\Tests\Licenses\Entities\Offer\PriceBand;

use ArrowSphere\PublicApiClient\Licenses\Entities\Offer\PriceBand\PriceBand;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

/**
 * Class PriceBandTest
 */
class PriceBandTest extends AbstractEntityTest
{
    protected const CLASS_NAME = PriceBand::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'isEnabled'       => false,
                    'currency'        => 'USD',
                    'marketplace'     => 'US',
                    'actionFlags'     => [
                        'canBeCancelled'   => true,
                        'canBeReactivated' => true,
                        'canBeSuspended'   => true,
                        'canDecreaseSeats' => true,
                        'canIncreaseSeats' => true,
                    ],
                    'billing'         => [
                        'cycle' => 720,
                        'term'  => 8640,
                        'type'  => 'my type',
                    ],
                    'prices'          => [
                        'buy'    => 12.34,
                        'sell'   => 56.78,
                        'public' => 98.76,
                    ],
                    'saleConstraints' => [
                        'minQuantity' => 12,
                        'maxQuantity' => 56,
                    ],
                ],
                'expected' => <<<JSON
{
    "actionFlags": {
        "canBeCancelled": true,
        "canBeReactivated": true,
        "canBeSuspended": true,
        "canDecreaseSeats": true,
        "canIncreaseSeats": true
    },
    "billing": {
        "cycle": 720,
        "term": 8640,
        "type": "my type"
    },
    "currency": "USD",
    "isEnabled": false,
    "marketplace": "US",
    "prices": {
        "buy": 12.34,
        "sell": 56.78,
        "public": 98.76
    },
    "saleConstraints": {
        "minQuantity": 12,
        "maxQuantity": 56
    }
}
JSON
            ],
        ];
    }
}
