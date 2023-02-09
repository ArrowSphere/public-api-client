<?php

namespace ArrowSphere\PublicApiClient\Tests\Licenses\Entities\License;

use ArrowSphere\PublicApiClient\Licenses\Entities\License\Predictions;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

/**
 * Class PredictionTest
 */
class PredictionsTest extends AbstractEntityTest
{
    protected const CLASS_NAME = Predictions::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields' => [
                    'currency' => 'EUR',
                    'updatedAt' => '2022-10-26',
                    'licenseReference' => 'XSP1234',
                    'predictions' => [
                    [
                        'date'=>'2022-10-24',
                        'amount'=>2545.45
                    ],
                    [
                        'date'=>'2022-10-25',
                        'amount'=>2305.34
                    ],
                ],
                ],
                'expected' => <<<JSON
{
    "currency": "EUR",
    "updatedAt": "2022-10-26",
    "licenseReference": "XSP1234",
    "predictions": [
        {
            "date": "2022-10-24",
            "amount": 2545.45
        },
        {
            "date": "2022-10-25",
            "amount": 2305.34
        }
    ]
}
JSON
                        ],
                ];
    }
}
