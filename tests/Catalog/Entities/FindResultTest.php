<?php

namespace ArrowSphere\PublicApiClient\Tests\Catalog\Entities;

use ArrowSphere\PublicApiClient\Catalog\Entities\FindResult;
use ArrowSphere\PublicApiClient\Catalog\OfferClient;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

/**
 * Class FindResultTest
 */
class FindResultTest extends AbstractEntityTest
{
    protected const CLASS_NAME = FindResult::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'products'   => [],
                    'filters'    => [],
                    'topOffers'  => [],
                    'pagination' => [
                        'current_page' => 1,
                        'total_page'   => 1,
                        'total'        => 0,
                    ],
                ],
                'expected' => <<<JSON
{
    "offers": {},
    "filters": [],
    "totalPage": 1,
    "nbResults": 0,
    "topOffer": []
}
JSON
                ,
            ],
        ];
    }

    protected function createEntity(array $fields): object
    {
        return new FindResult($fields, $this->getMockBuilder(OfferClient::class)->getMock(), [], []);
    }
}
