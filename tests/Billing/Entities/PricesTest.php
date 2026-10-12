<?php

namespace ArrowSphere\PublicApiClient\Tests\Billing\Entities;

use ArrowSphere\PublicApiClient\Billing\Entities\Prices;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class PricesTest extends AbstractEntityTest
{
    protected const CLASS_NAME = Prices::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'listUnit'  => 12.5,
                    'listTotal' => 12.5,
                    'buyUnit'   => 12.5,
                    'buyTotal'  => 12.5,
                    'sellUnit'  => 12.5,
                    'sellTotal' => 12.5,
                ],
                'expected' => <<<JSON
{
    "listUnit": 12.5,
    "listTotal": 12.5,
    "buyUnit": 12.5,
    "buyTotal": 12.5,
    "sellUnit": 12.5,
    "sellTotal": 12.5
}
JSON
                ,
            ],
        ];
    }
}
