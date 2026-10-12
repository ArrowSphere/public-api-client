<?php

namespace ArrowSphere\PublicApiClient\Tests\Orders\Entities;

use ArrowSphere\PublicApiClient\Orders\Entities\Prices;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class PricesTest extends AbstractEntityTest
{
    protected const CLASS_NAME = Prices::class;

    public function providerSerialization(): array
    {
        return [
            'prices with decimals' => [
                'fields'   => ['buy' => 10.5, 'sell' => 12.25, 'currency' => 'USD', 'periodicity' => 'Monthly', 'term' => 'Annual', 'periodicityCode' => 720, 'termCode' => 8640],
                'expected' => <<<JSON
{
    "buy": 10.5,
    "sell": 12.25,
    "currency": "USD",
    "periodicity": "Monthly",
    "term": "Annual",
    "periodicityCode": 720,
    "termCode": 8640
}
JSON
                ,
            ],
            'prices without decimal' => [
                'fields'   => ['buy' => 10, 'sell' => 12, 'currency' => 'USD', 'periodicity' => 'Monthly', 'term' => 'Annual', 'periodicityCode' => 720, 'termCode' => 8640],
                'expected' => <<<JSON
{
    "buy": 10,
    "sell": 12,
    "currency": "USD",
    "periodicity": "Monthly",
    "term": "Annual",
    "periodicityCode": 720,
    "termCode": 8640
}
JSON
                ,
            ],
        ];
    }
}
