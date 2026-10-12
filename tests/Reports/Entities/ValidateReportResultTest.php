<?php

namespace ArrowSphere\PublicApiClient\Tests\Reports\Entities;

use ArrowSphere\PublicApiClient\Reports\Entities\ValidateReportResult;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class ValidateReportResultTest extends AbstractEntityTest
{
    protected const CLASS_NAME = ValidateReportResult::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'orders' => [
                        [
                            'reference' => 'my reference',
                            'link'      => 'my link',
                        ],
                    ],
                ],
                'expected' => <<<JSON
{
    "orders": [
        {
            "reference": "my reference",
            "link": "my link"
        }
    ]
}
JSON
                ,
            ],
        ];
    }
}
