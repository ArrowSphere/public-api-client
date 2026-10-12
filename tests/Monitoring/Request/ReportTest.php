<?php

namespace ArrowSphere\PublicApiClient\Tests\Monitoring\Request;

use ArrowSphere\PublicApiClient\Monitoring\Request\Report;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class ReportTest extends AbstractEntityTest
{
    protected const CLASS_NAME = Report::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'body'      => [
                        'my body',
                    ],
                    'url'       => 'my url',
                    'type'      => 'my type',
                    'userAgent' => 'my user agent',
                ],
                'expected' => <<<JSON
{
    "body": [
        "my body"
    ],
    "url": "my url",
    "type": "my type",
    "userAgent": "my user agent"
}
JSON
                ,
            ],
        ];
    }
}
