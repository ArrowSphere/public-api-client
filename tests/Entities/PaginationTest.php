<?php

namespace ArrowSphere\PublicApiClient\Tests\Entities;

use ArrowSphere\PublicApiClient\Entities\Pagination;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class PaginationTest extends AbstractEntityTest
{
    protected const CLASS_NAME = Pagination::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'per_page'     => 10,
                    'current_page' => 2,
                    'total_page'   => 3,
                    'total'        => 25,
                    'next'         => '/api/customers?page=3',
                    'previous'     => '/api/customers?page=1',
                ],
                'expected' => <<<JSON
{
    "per_page": 10,
    "current_page": 2,
    "total_page": 3,
    "total": 25,
    "next": "\/api\/customers?page=3",
    "previous": "\/api\/customers?page=1"
}
JSON
                ,
            ],
            'empty' => [
                'fields'   => [],
                'expected' => <<<JSON
{
    "per_page": null,
    "current_page": 1,
    "total_page": null,
    "total": null,
    "next": "",
    "previous": ""
}
JSON
                ,
            ],
        ];
    }
}
