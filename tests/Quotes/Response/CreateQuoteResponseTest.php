<?php

namespace ArrowSphere\PublicApiClient\Tests\Quotes\Response;

use ArrowSphere\PublicApiClient\Quotes\Response\CreateQuoteResponse;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class CreateQuoteResponseTest extends AbstractEntityTest
{
    protected const CLASS_NAME = CreateQuoteResponse::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'link'      => '/api/quotes/XSPQ1',
                    'reference' => 'XSPQ1',
                    'status'    => 'Draft',
                ],
                'expected' => <<<JSON
{
    "reference": "XSPQ1",
    "status": "Draft",
    "link": "\/api\/quotes\/XSPQ1"
}
JSON
                ,
            ],
        ];
    }

    public function testGetterValues(): void
    {
        $response = new CreateQuoteResponse($this->providerSerialization()['standard']['fields']);

        self::assertSame('XSPQ1', $response->getReference());
        self::assertSame('Draft', $response->getStatus());
        self::assertSame('/api/quotes/XSPQ1', $response->getLink());
    }
}
