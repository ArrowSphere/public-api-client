<?php

namespace ArrowSphere\PublicApiClient\Tests;

use ArrowSphere\PublicApiClient\Catalog\CatalogClient;
use Curl\Curl;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CatalogClientTest extends TestCase
{
    public function testFind(): void
    {
        /** @var MockObject|Curl $curler */
        $curler = $this->getMockBuilder(Curl::class)
            ->disableOriginalConstructor()
            ->getMock();

        $catalogClient = new CatalogClient($curler);
        $catalogClient->setUrl('https://www.test.com');
        $catalogClient->setApiKey('123456');
        $catalogClient->setPage(2);
        $catalogClient->setPerPage(15);
        $catalogClient->setKeywords('office 365');
        $catalogClient->setFilters(['vendor' => 'Microsoft']);
        $catalogClient->setSort(['name' => 'desc']);
        $catalogClient->setHighlight(true);
        $catalogClient->setTopOffers(true);

        $curler->response = 'OK USA';

        $curler->expects(self::once())
            ->method('post')
            ->with('https://www.test.com/catalog/find?page=2&per_page=15', json_encode([
                'keywords'  => 'office 365',
                'filters'   => ['vendor' => 'Microsoft'],
                'sort'      => ['name' => 'desc'],
                'highlight' => true,
                'topOffers' => true,
            ]));

        $catalogClient->postFind();
    }

    public function testGetServices(): void
    {
        /** @var MockObject|Curl $curler */
        $curler = $this->getMockBuilder(Curl::class)
            ->disableOriginalConstructor()
            ->getMock();

        $catalogClient = new CatalogClient($curler);
        $catalogClient->setUrl('https://www.test.com');
        $catalogClient->setApiKey('123456');

        $curler->response = 'OK USA';

        $curler->expects(self::once())
            ->method('get')
            ->with('https://www.test.com/catalog/categories/myType/programs/myVendor/products');

        $catalogClient->getServices('myType', 'myVendor');
    }

    public function testGetAllServices(): void
    {
        /** @var MockObject|Curl $curler */
        $curler = $this->getMockBuilder(Curl::class)
            ->disableOriginalConstructor()
            ->getMock();

        $catalogClient = new CatalogClient($curler);
        $catalogClient->setUrl('https://www.test.com');
        $catalogClient->setApiKey('123456');

        $curler->response = json_encode([
            'data'       => [],
            'pagination' => [
                'total_page' => 3,
            ],
        ]);

        $curler->expects(self::exactly(3))
            ->method('get')
            ->withConsecutive(
                ['https://www.test.com/catalog/categories/myType/programs/myVendor/products?per_page=100'],
                ['https://www.test.com/catalog/categories/myType/programs/myVendor/products?page=2&per_page=100'],
                ['https://www.test.com/catalog/categories/myType/programs/myVendor/products?page=3&per_page=100']
            );

        $test = $catalogClient->getAllServices('myType', 'myVendor');
        iterator_to_array($test);
    }

    public function testGetDetails(): void
    {
        /** @var MockObject|Curl $curler */
        $curler = $this->getMockBuilder(Curl::class)
            ->disableOriginalConstructor()
            ->getMock();

        $catalogClient = new CatalogClient($curler);
        $catalogClient->setUrl('https://www.test.com');
        $catalogClient->setApiKey('123456');

        $curler->response = 'OK USA';

        $curler->expects(self::once())
            ->method('get')
            ->with('https://www.test.com/catalog/details/myType/myVendor/mySku');

        $catalogClient->getDetails('myType', 'myVendor', 'mySku');
    }

    public function testGetDetailsDisabled(): void
    {
        /** @var MockObject|Curl $curler */
        $curler = $this->getMockBuilder(Curl::class)
            ->disableOriginalConstructor()
            ->getMock();

        $catalogClient = new CatalogClient($curler);
        $catalogClient->setUrl('https://www.test.com');
        $catalogClient->setApiKey('123456');

        $curler->response = 'OK USA';

        $curler->expects(self::once())
            ->method('get')
            ->with('https://www.test.com/catalog/details/myType/myVendor/mySku?enabled=0');

        $catalogClient->getDetails('myType', 'myVendor', 'mySku', ['enabled' => 0]);
    }
}
