<?php

namespace ArrowSphere\PublicApiClient\Tests;

use ArrowSphere\PublicApiClient\Catalog\CatalogClient;
use GuzzleHttp\Psr7\Response;

/**
 * Class CatalogClientTest
 *
 * @property CatalogClient $client
 */
class CatalogClientTest extends AbstractClientTest
{
    protected const MOCKED_CLIENT_CLASS = CatalogClient::class;

    public function testFind(): void
    {
        $this->client->setPage(2);
        $this->client->setPerPage(15);
        $this->client->setKeywords('office 365');
        $this->client->setFilters(['vendor' => 'Microsoft']);
        $this->client->setSort(['name' => 'desc']);
        $this->client->setHighlight(true);
        $this->client->setTopOffers(true);

        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with(
                'post',
                'https://www.test.com/catalog/find?page=2&per_page=15',
                [
                    'headers' => [
                        'apiKey' => '123456',
                        'Content-Type' => 'application/json',
                    ],
                    'body'    => json_encode(
                        [
                            'keywords'  => 'office 365',
                            'filters'   => ['vendor' => 'Microsoft'],
                            'sort'      => ['name' => 'desc'],
                            'highlight' => true,
                            'topOffers' => true,
                        ]
                    ),
                ]
            )
            ->willReturn(new Response(200, [], 'OK USA'));

        $this->client->postFind();
    }

    public function testGetServices(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/catalog/categories/myType/programs/myVendor/products')
            ->willReturn(new Response(200, [], 'OK USA'));

        $this->client->getServices('myType', 'myVendor');
    }

    public function testGetAllServices(): void
    {
        $response = json_encode([
            'data'       => [],
            'pagination' => [
                'total_page' => 3,
            ],
        ]);

        $this->httpClient
            ->expects(self::exactly(3))
            ->method('request')
            ->withConsecutive(
                ['get', 'https://www.test.com/catalog/categories/myType/programs/myVendor/products?per_page=100'],
                ['get', 'https://www.test.com/catalog/categories/myType/programs/myVendor/products?page=2&per_page=100'],
                ['get', 'https://www.test.com/catalog/categories/myType/programs/myVendor/products?page=3&per_page=100']
            )
            ->willReturn(new Response(200, [], $response));

        $test = $this->client->getAllServices('myType', 'myVendor');
        iterator_to_array($test);
    }

    public function testGetDetails(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/catalog/details/myType/myVendor/mySku')
            ->willReturn(new Response(200, [], 'OK USA'));

        $this->client->getDetails('myType', 'myVendor', 'mySku');
    }

    public function testGetDetailsDisabled(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/catalog/details/myType/myVendor/mySku?enabled=0')
            ->willReturn(new Response(200, [], 'OK USA'));

        $this->client->getDetails('myType', 'myVendor', 'mySku', ['enabled' => 0]);
    }
}
