<?php

namespace ArrowSphere\PublicApiClient\Tests\Licenses\Entities\Offer\PriceBand;

use ArrowSphere\PublicApiClient\Licenses\Entities\Offer\PriceBand\Billing;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

/**
 * Class BillingTest
 */
class BillingTest extends AbstractEntityTest
{
    protected const CLASS_NAME = Billing::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'cycle' => 720,
                    'term' => 8640,
                    'type' => 'my type',
                ],
                'expected' => <<<JSON
{
    "cycle": 720,
    "term": 8640,
    "type": "my type"
}
JSON
            ],
        ];
    }
}
