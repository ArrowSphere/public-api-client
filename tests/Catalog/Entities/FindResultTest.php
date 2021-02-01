<?php

namespace ArrowSphere\PublicApiClient\Tests\Catalog\Entities;

use ArrowSphere\PublicApiClient\Catalog\Entities\FindResult;
use ArrowSphere\PublicApiClient\Catalog\OfferClient;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;
use PHPUnit\Framework\TestCase;

/**
 * Class FindResultTest
 */
class FindResultTest extends TestCase
{
    /**
     * @throws EntityValidationException
     */
    public function testSerialisation(): void
    {
        $findResult = new FindResult(
            [
                'products'   => [],
                'filters'    => [],
                'topOffers'  => [],
                'pagination' => [
                    'current_page' => 1,
                    'total_page'   => 1,
                    'total'        => 0,
                ],
            ],
            $this->getMockBuilder(OfferClient::class)->getMock(),
            [],
            []
        );

        $expected = <<<JSON
{
    "offers": {},
    "filters": [],
    "totalPage": 1,
    "nbResults": 0,
    "topOffer": []
}
JSON;

        self::assertEquals($expected, json_encode($findResult, JSON_PRETTY_PRINT));
    }
}
