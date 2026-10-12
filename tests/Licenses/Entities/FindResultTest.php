<?php

namespace ArrowSphere\PublicApiClient\Tests\Licenses\Entities;

use ArrowSphere\PublicApiClient\Licenses\Entities\FindResult;
use ArrowSphere\PublicApiClient\Licenses\LicensesClient;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class FindResultTest extends AbstractEntityTest
{
    protected const CLASS_NAME = FindResult::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'results'    => [],
                    'filters'    => [
                        [
                            'name'   => 'vendor',
                            'values' => [],
                        ],
                    ],
                    'pagination' => [
                        'currentPage' => 1,
                        'totalPage'   => 1,
                        'total'       => 0,
                    ],
                ],
                'expected' => <<<JSON
{
    "results": {},
    "filters": [
        {
            "name": "vendor",
            "values": []
        }
    ],
    "totalPage": 1,
    "nbResults": 0
}
JSON
                ,
            ],
        ];
    }

    protected function createEntity(array $fields): object
    {
        return new FindResult($fields, $this->getMockBuilder(LicensesClient::class)->disableOriginalConstructor()->getMock(), [], []);
    }
}
