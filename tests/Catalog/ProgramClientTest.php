<?php

namespace ArrowSphere\PublicApiClient\Tests\Catalog;

use ArrowSphere\PublicApiClient\Catalog\Entities\Program;
use ArrowSphere\PublicApiClient\Catalog\ProgramClient;
use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use ArrowSphere\PublicApiClient\Tests\AbstractClientTest;
use GuzzleHttp\Psr7\Response;

/**
 * Class ProgramClientTest
 *
 * @property ProgramClient $client
 */
class ProgramClientTest extends AbstractClientTest
{
    protected const MOCKED_CLIENT_CLASS = ProgramClient::class;

    /**
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function testGetProgramsRaw(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/catalog/categories/SAAS/programs')
            ->willReturn(new Response(200, [], 'OK USA'));

        $this->client->getProgramsRaw('SAAS');
    }

    /**
     * @depends testGetProgramsRaw
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function testGetProgramsWithInvalidResponse(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/catalog/categories/SAAS/programs?per_page=100')
            ->willReturn(new Response(200, [], '{'));

        $this->expectException(PublicApiClientException::class);
        $programs = $this->client->getPrograms('SAAS');
        iterator_to_array($programs);
    }

    /**
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function testGetProgramsWithPagination(): void
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
                ['get', 'https://www.test.com/catalog/categories/myType/programs?per_page=100'],
                ['get', 'https://www.test.com/catalog/categories/myType/programs?page=2&per_page=100'],
                ['get', 'https://www.test.com/catalog/categories/myType/programs?page=3&per_page=100']
            )
            ->willReturn(new Response(200, [], $response));

        $test = $this->client->getPrograms('myType');
        iterator_to_array($test);
    }

    /**
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function testGetPrograms(): void
    {
        $response = <<<JSON
{
  "status": 200,
  "data": [
    {
      "reference": "ibm",
      "name": "IBM Corp.",
      "associatedSubscriptionProgram": "IBM-3PM",
      "logo": "/index.php/site/img/type/vendor/ref/8",
      "category": "SAAS",
      "links": {
        "program": "/api/catalog/categories/SAAS/programs/ibm",
        "products": "/api/catalog/categories/SAAS/programs/ibm/products"
      }
    },
    {
      "reference": "microsoft",
      "name": "Microsoft",
      "associatedSubscriptionProgram": "MSCSP",
      "logo": "/index.php/site/img/type/vendor/ref/3",
      "category": "SAAS",
      "links": {
        "program": "/api/catalog/categories/SAAS/programs/microsoft",
        "products": "/api/catalog/categories/SAAS/programs/microsoft/products"
      }
    }
  ],
  "pagination": {
    "per_page": 100,
    "current_page": 1,
    "total_page": 1,
    "total": 2,
    "next": null,
    "previous": null
  }
}
JSON;

        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/catalog/categories/SAAS/programs?per_page=100')
            ->willReturn(new Response(200, [], $response));

        $test = $this->client->getPrograms('SAAS');
        $list = iterator_to_array($test);
        self::assertCount(2, $list);

        /** @var Program $program */
        $program = array_shift($list);
        self::assertInstanceOf(Program::class, $program);
        self::assertEquals('IBM Corp.', $program->getName());
        self::assertEquals('SAAS', $program->getClassification());
        self::assertEquals('IBM-3PM', $program->getAssociatedSubscriptionProgram());
        self::assertEquals('/index.php/site/img/type/vendor/ref/8', $program->getLogo());
        self::assertEquals('ibm', $program->getReference());

        /** @var Program $program */
        $program = array_shift($list);
        self::assertInstanceOf(Program::class, $program);
        self::assertEquals('Microsoft', $program->getName());
        self::assertEquals('SAAS', $program->getClassification());
        self::assertEquals('MSCSP', $program->getAssociatedSubscriptionProgram());
        self::assertEquals('/index.php/site/img/type/vendor/ref/3', $program->getLogo());
        self::assertEquals('microsoft', $program->getReference());
    }

    /**
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function testGetProgramRaw(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/catalog/categories/SAAS/programs/microsoft')
            ->willReturn(new Response(200, [], 'OK USA'));

        $this->client->getProgramRaw('SAAS', 'microsoft');
    }

    /**
     * @depends testGetProgramRaw
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function testGetProgramWithInvalidResponse(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/catalog/categories/SAAS/programs/microsoft')
            ->willReturn(new Response(200, [], '{'));

        $this->expectException(PublicApiClientException::class);
        $this->client->getProgram('SAAS', 'microsoft');
    }

    /**
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function testGetProgram(): void
    {
        $response = <<<JSON
{
  "status": 200,
  "data": {
    "reference": "microsoft",
    "name": "Microsoft",
    "associatedSubscriptionProgram": "MSCSP",
    "logo": "/index.php/site/img/type/vendor/ref/3",
    "category": "SAAS",
    "links": {
      "program": "/api/catalog/categories/SAAS/programs/microsoft",
      "products": "/api/catalog/categories/SAAS/programs/microsoft/products"
    }
  }
}
JSON;

        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/catalog/categories/SAAS/programs/microsoft')
            ->willReturn(new Response(200, [], $response));

        $program = $this->client->getProgram('SAAS', 'microsoft');

        self::assertEquals('Microsoft', $program->getName());
        self::assertEquals('SAAS', $program->getClassification());
        self::assertEquals('MSCSP', $program->getAssociatedSubscriptionProgram());
        self::assertEquals('/index.php/site/img/type/vendor/ref/3', $program->getLogo());
        self::assertEquals('microsoft', $program->getReference());
    }
}
