<?php

namespace ArrowSphere\PublicApiClient\Tests\Catalog;

use ArrowSphere\PublicApiClient\Catalog\ClassificationClient;
use ArrowSphere\PublicApiClient\Catalog\Entities\Classification;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;
use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use ArrowSphere\PublicApiClient\Tests\AbstractClientTest;
use GuzzleHttp\Psr7\Response;

/**
 * Class ClassificationClientTest
 *
 * @property ClassificationClient $client
 */
class ClassificationClientTest extends AbstractClientTest
{
    protected const MOCKED_CLIENT_CLASS = ClassificationClient::class;

    /**
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function testGetClassificationsRaw(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('get')
            ->with('https://www.test.com/catalog/categories')
            ->willReturn(new Response(200, [], 'OK USA'));

        $this->client->getClassificationsRaw();
    }

    /**
     * @depends testGetClassificationsRaw
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function testGetClassificationsWithInvalidResponse(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('get')
            ->with('https://www.test.com/catalog/categories')
            ->willReturn(new Response(200, [], '{'));

        $this->expectException(PublicApiClientException::class);
        $classifications = $this->client->getClassifications();
        iterator_to_array($classifications);
    }

    /**
     * @depends testGetClassificationsRaw
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function testGetClassifications(): void
    {
        $response = <<<JSON
{
  "status": 200,
  "data": [
    {
      "name": "SAAS",
      "links": {
        "programs": "/api/catalog/categories/SAAS/programs"
      }
    },
    {
      "name": "PSW",
      "links": {
        "programs": "/api/catalog/categories/PSW/programs"
      }
    },
    {
      "name": "FTSL",
      "links": {
        "programs": "/api/catalog/categories/FTSL/programs"
      }
    },
    {
      "name": "IAAS",
      "links": {
        "programs": "/api/catalog/categories/IAAS/programs"
      }
    }
  ]
}
JSON;

        $this->httpClient
            ->expects(self::once())
            ->method('get')
            ->with('https://www.test.com/catalog/categories')
            ->willReturn(new Response(200, [], $response));

        $test = $this->client->getClassifications();
        $list = iterator_to_array($test);
        self::assertCount(4, $list);

        /** @var Classification $category */
        $category = array_shift($list);
        self::assertInstanceOf(Classification::class, $category);
        self::assertEquals('SAAS', $category->getName());

        /** @var Classification $category */
        $category = array_shift($list);
        self::assertInstanceOf(Classification::class, $category);
        self::assertEquals('PSW', $category->getName());

        /** @var Classification $category */
        $category = array_shift($list);
        self::assertInstanceOf(Classification::class, $category);
        self::assertEquals('FTSL', $category->getName());

        /** @var Classification $category */
        $category = array_shift($list);
        self::assertInstanceOf(Classification::class, $category);
        self::assertEquals('IAAS', $category->getName());
    }
}
