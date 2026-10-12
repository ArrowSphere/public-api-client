<?php

namespace ArrowSphere\PublicApiClient\Tests\Entities;

use ArrowSphere\PublicApiClient\Entities\Pagination;
use PHPUnit\Framework\TestCase;

class PaginationTest extends TestCase
{
    public function testJsonEncode(): void
    {
        $pagination = new Pagination([
            'per_page'     => 10,
            'current_page' => 2,
            'total_page'   => 3,
            'total'        => 25,
            'next'         => '/api/customers?page=3',
            'previous'     => '/api/customers?page=1',
        ]);

        self::assertSame(json_encode($pagination->jsonSerialize()), json_encode($pagination));
        self::assertSame(2, $pagination->getCurrentPage());
    }
}
