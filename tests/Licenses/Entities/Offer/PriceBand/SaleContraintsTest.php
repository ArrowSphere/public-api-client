<?php

namespace ArrowSphere\PublicApiClient\Tests\Licenses\Entities\Offer\PriceBand;

use ArrowSphere\PublicApiClient\Licenses\Entities\Offer\PriceBand\SaleConstraints;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

/**
 * Class SaleContraintsTest
 */
class SaleContraintsTest extends AbstractEntityTest
{
    protected const CLASS_NAME = SaleConstraints::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'minQuantity' => 12,
                    'maxQuantity' => 56,
                ],
                'expected' => <<<JSON
{
    "minQuantity": 12,
    "maxQuantity": 56
}
JSON
            ],
        ];
    }
}
