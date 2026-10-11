<?php

namespace ArrowSphere\PublicApiClient\Tests\Quotes\Response;

use ArrowSphere\PublicApiClient\Quotes\Response\CreateQuoteResponse;
use PHPUnit\Framework\TestCase;

class CreateQuoteResponseTest extends TestCase
{
    public function testSerialization(): void
    {
        $response = new CreateQuoteResponse([
            'link'      => '/api/quotes/XSPQ1',
            'reference' => 'XSPQ1',
            'status'    => 'Draft',
        ]);

        self::assertSame('XSPQ1', $response->getReference());
        self::assertSame('Draft', $response->getStatus());
        self::assertSame('/api/quotes/XSPQ1', $response->getLink());
        self::assertSame('{"reference":"XSPQ1","status":"Draft","link":"\/api\/quotes\/XSPQ1"}', json_encode($response));
    }
}
