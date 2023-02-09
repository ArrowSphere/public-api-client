<?php

namespace ArrowSphere\PublicApiClient\Tests\Licenses\Entities\License;

use ArrowSphere\PublicApiClient\Licenses\Entities\License\PredictionResponse;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

/**
 * Class PredictionResponseTest
 */
class PredictionResponseTest extends AbstractEntityTest
{
    protected const CLASS_NAME = PredictionResponse::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields' => [
                    'date'=> '2022-10-25',
                    'amount'=> 4564.5
                ],
                'expected' => <<<JSON
{
    "date": "2022-10-25",
    "amount": 4564.5
}
JSON
                        ],
                ];
    }
}
