<?php

namespace ArrowSphere\PublicApiClient\Tests\Reports\Entities;

use ArrowSphere\PublicApiClient\Reports\Entities\ValidateReportOrder;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class ValidateReportOrderTest extends AbstractEntityTest
{
    protected const CLASS_NAME = ValidateReportOrder::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'reference' => 'my reference',
                    'link'      => 'my link',
                ],
                'expected' => <<<JSON
{
    "reference": "my reference",
    "link": "my link"
}
JSON
                ,
            ],
        ];
    }
}
