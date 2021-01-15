<?php

namespace ArrowSphere\PublicApiClient\Tests\Catalog;

use ArrowSphere\PublicApiClient\Catalog\Entities\Service;
use ArrowSphere\PublicApiClient\Catalog\ServiceClient;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;
use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use ArrowSphere\PublicApiClient\Tests\AbstractClientTest;

/**
 * Class ServiceClientTest
 *
 * @property ServiceClient $client
 */
class ServiceClientTest extends AbstractClientTest
{
    protected const MOCKED_CLIENT_CLASS = ServiceClient::class;

    /**
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function testGetServicesRaw(): void
    {
        $this->curler->response = 'OK USA';

        $this->curler->expects(self::once())
            ->method('get')
            ->with('https://www.test.com/catalog/categories/SAAS/programs/microsoft/products');

        $this->client->getServicesRaw('SAAS', 'microsoft');
    }

    /**
     * @depends testGetServicesRaw
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function testGetServicesWithInvalidResponse(): void
    {
        $this->curler->response = '{';

        $this->expectException(PublicApiClientException::class);
        $services = $this->client->getServices('SAAS', 'microsoft');
        iterator_to_array($services);
    }

    /**
     * @depends testGetServicesRaw
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function testGetServicesWithPagination(): void
    {
        $this->curler->response = json_encode([
            'data'       => [],
            'pagination' => [
                'total_page' => 3,
            ],
        ]);

        $this->curler->expects(self::exactly(3))
            ->method('get')
            ->withConsecutive(
                ['https://www.test.com/catalog/categories/SAAS/programs/microsoft/products?per_page=100'],
                ['https://www.test.com/catalog/categories/SAAS/programs/microsoft/products?page=2&per_page=100'],
                ['https://www.test.com/catalog/categories/SAAS/programs/microsoft/products?page=3&per_page=100']
            );

        $test = $this->client->getServices('SAAS', 'microsoft');
        iterator_to_array($test);
    }

    /**
     * @depends testGetServicesRaw
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function testGetServices(): void
    {
        $this->curler->response = <<<JSON
{
  "status": 200,
  "data": [
    {
      "reference": "MS-9B-O365-EDU",
      "name": "Office 365 (Education)",
      "associatedSubscriptionProgram": "MSCSP",
      "serviceTags": [
        "Productivity"
      ],
      "logo": "https://websource.myportal.cloud/images/Office365.jpg",
      "icon": "https://websource.myportal.cloud/images/icon/Office365.jpg",
      "program": "Microsoft",
      "category": "SAAS",
      "prices": [
        {
          "min_quantity": 1,
          "max_quantity": "10000000",
          "recurring_buy_price": 0,
          "recurring_sell_price": 0,
          "term": "1 Year",
          "unit_type": "LICENSE",
          "periodicity": "per Month",
          "recurring_time_unit": "per Month",
          "setup_buy_price": 0,
          "setup_sell_price": 0,
          "setup_time_unit": "One-Time",
          "currency": "USD",
          "availability_date": "2020-11-01T00:00:00+00:00",
          "expiry_date": "9999-12-31T00:00:00+00:00"
        },
        {
          "min_quantity": 1,
          "max_quantity": "10000000",
          "recurring_buy_price": 0,
          "recurring_sell_price": 0,
          "term": "1 Year",
          "unit_type": "LICENSE",
          "periodicity": "per Year",
          "recurring_time_unit": "per Year",
          "setup_buy_price": 0,
          "setup_sell_price": 0,
          "setup_time_unit": "One-Time",
          "currency": "USD",
          "availability_date": "2020-11-01T00:00:00+00:00",
          "expiry_date": "9999-12-31T00:00:00+00:00"
        }
      ],
      "orderableSku": "U0FBU3x8TWljcm9zb2Z0fHxNUy05Qi1PMzY1LUVEVQ==",
      "features": "features",
      "requirements": "requirements",
      "endUserEula": "end user eula",
      "endUserFeatures": "end user features",
      "endUserRequirements": "end user requirements",
      "keywords": [
        "Education"
      ],
      "links": {
        "program": "/api/catalog/categories/SAAS/programs/microsoft",
        "product": "/api/catalog/categories/SAAS/programs/microsoft/products/MS-9B-O365-EDU",
        "offers": "/api/catalog/categories/SAAS/programs/microsoft/products/MS-9B-O365-EDU/offers"
      },
      "vendor": "MSCSP"
    },
    {
      "reference": "MS-0B-O365-ENTERPRIS",
      "name": "Office 365 Enterprise – (Corporate)",
      "associatedSubscriptionProgram": "MSCSP",
      "description": "Each Dynamics 365 Customer Voice add-on provides access to...",
      "serviceTags": [
        "Productivity"
      ],
      "logo": "https://websource.myportal.cloud/images/Office365.jpg",
      "icon": "https://websource.myportal.cloud/images/icon/Office365.jpg",
      "program": "Microsoft",
      "category": "SAAS",
      "prices": [
        {
          "min_quantity": 1,
          "max_quantity": "10000000",
          "recurring_buy_price": 50,
          "recurring_sell_price": 60,
          "term": "1 Year",
          "unit_type": "LICENSE",
          "periodicity": "per Month",
          "recurring_time_unit": "per Month",
          "setup_buy_price": 0,
          "setup_sell_price": 0,
          "setup_time_unit": "One-Time",
          "currency": "DKK",
          "availability_date": "2020-11-01T00:00:00+00:00",
          "expiry_date": "9999-12-31T00:00:00+00:00"
        },
        {
          "min_quantity": 1,
          "max_quantity": "10000000",
          "recurring_buy_price": 600,
          "recurring_sell_price": 700,
          "term": "1 Year",
          "unit_type": "LICENSE",
          "periodicity": "per Year",
          "recurring_time_unit": "per Year",
          "setup_buy_price": 0,
          "setup_sell_price": 0,
          "setup_time_unit": "One-Time",
          "currency": "DKK",
          "availability_date": "2020-11-01T00:00:00+00:00",
          "expiry_date": "9999-12-31T00:00:00+00:00"
        }
      ],
      "orderableSku": "U0FBU3x8TWljcm9zb2Z0fHxNUy0wQi1PMzY1LUVOVEVSUFJJUw==",
      "features": "features",
      "requirements": "requirements",
      "endUserEula": "end user eula",
      "endUserFeatures": "end user features",
      "endUserRequirements": "end user requirements",
      "keywords": [
        "Corporate"
      ],
      "links": {
        "program": "/api/catalog/categories/SAAS/programs/microsoft",
        "product": "/api/catalog/categories/SAAS/programs/microsoft/products/MS-0B-O365-ENTERPRIS",
        "offers": "/api/catalog/categories/SAAS/programs/microsoft/products/MS-0B-O365-ENTERPRIS/offers"
      },
      "vendor": "MSCSP"
    }
  ],
  "pagination": {
    "per_page": 2,
    "current_page": 1,
    "total_page": 1,
    "total": 2,
    "next": "/catalog/categories/SAAS/programs/microsoft/products?page=2",
    "previous": null
  }
}
JSON;

        $this->curler->expects(self::once())
            ->method('get')
            ->with('https://www.test.com/catalog/categories/SAAS/programs/microsoft/products?per_page=100');

        $test = $this->client->getServices('SAAS', 'microsoft');
        $list = iterator_to_array($test);
        self::assertCount(2, $list);

        /** @var Service $service */
        $service = array_shift($list);
        self::assertInstanceOf(Service::class, $service);
        self::assertEquals('Office 365 (Education)', $service->getName());
        self::assertEquals('SAAS', $service->getClassification());
        self::assertEquals('MSCSP', $service->getAssociatedSubscriptionProgram());
        self::assertEquals('MS-9B-O365-EDU', $service->getReference());
        self::assertEquals('', $service->getDescription());
        self::assertEquals('Microsoft', $service->getProgram());
        self::assertEquals(['Productivity'], $service->getServiceTags());

        /** @var Service $service */
        $service = array_shift($list);
        self::assertInstanceOf(Service::class, $service);
        self::assertEquals('Office 365 Enterprise – (Corporate)', $service->getName());
        self::assertEquals('SAAS', $service->getClassification());
        self::assertEquals('MSCSP', $service->getAssociatedSubscriptionProgram());
        self::assertEquals('MS-0B-O365-ENTERPRIS', $service->getReference());
        self::assertEquals('Each Dynamics 365 Customer Voice add-on provides access to...', $service->getDescription());
        self::assertEquals('Microsoft', $service->getProgram());
        self::assertEquals(['Productivity'], $service->getServiceTags());
    }

    /**
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function testGetServiceRaw(): void
    {
        $this->curler->response = 'OK USA';

        $this->curler->expects(self::once())
            ->method('get')
            ->with('https://www.test.com/catalog/categories/SAAS/programs/microsoft/products/MS-0B-O365-ENTERPRIS');

        $this->client->getServiceRaw('SAAS', 'microsoft', 'MS-0B-O365-ENTERPRIS');
    }

    /**
     * @depends testGetServiceRaw
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function testGetServiceWithInvalidResponse(): void
    {
        $this->curler->response = '{';

        $this->expectException(PublicApiClientException::class);
        $this->client->getService('SAAS', 'microsoft', 'MS-0B-O365-ENTERPRIS');
    }

    /**
     * @depends testGetServiceRaw
     */
    public function testGetService(): void
    {
        $this->curler->response = <<<JSON
{
  "status": 200,
  "data": {
    "reference": "MS-0B-O365-ENTERPRIS",
    "name": "Office 365 Enterprise – (Corporate)",
    "associatedSubscriptionProgram": "MSCSP",
    "description": "Each Dynamics 365 Customer Voice add-on provides access to...",
    "serviceTags": [
      "Productivity"
    ],
    "logo": "https://websource.myportal.cloud/images/Office365.jpg",
    "icon": "https://websource.myportal.cloud/images/icon/Office365.jpg",
    "program": "Microsoft",
    "category": "SAAS",
    "prices": [
      {
        "min_quantity": 1,
        "max_quantity": "10000000",
        "recurring_buy_price": 50,
        "recurring_sell_price": 60,
        "term": "1 Year",
        "unit_type": "LICENSE",
        "periodicity": "per Month",
        "recurring_time_unit": "per Month",
        "setup_buy_price": 0,
        "setup_sell_price": 0,
        "setup_time_unit": "One-Time",
        "currency": "USD",
        "availability_date": "2020-11-01T00:00:00+00:00",
        "expiry_date": "9999-12-31T00:00:00+00:00"
      },
      {
        "min_quantity": 1,
        "max_quantity": "10000000",
        "recurring_buy_price": 600,
        "recurring_sell_price": 700,
        "term": "1 Year",
        "unit_type": "LICENSE",
        "periodicity": "per Year",
        "recurring_time_unit": "per Year",
        "setup_buy_price": 0,
        "setup_sell_price": 0,
        "setup_time_unit": "One-Time",
        "currency": "USD",
        "availability_date": "2020-11-01T00:00:00+00:00",
        "expiry_date": "9999-12-31T00:00:00+00:00"
      }
    ],
    "orderableSku": "U0FBU3x8TWljcm9zb2Z0fHxNUy0wQi1PMzY1LUVOVEVSUFJJUw==",
    "features": "features",
    "requirements": "requirements",
    "endUserEula": "end user eula",
    "endUserFeatures": "end user features",
    "endUserRequirements": "end user requirements",
    "keywords": [
      "Corporate"
    ],
    "links": {
      "program": "/api/catalog/categories/SAAS/programs/microsoft",
      "product": "/api/catalog/categories/SAAS/programs/microsoft/products/MS-0B-O365-ENTERPRIS",
      "offers": "/api/catalog/categories/SAAS/programs/microsoft/products/MS-0B-O365-ENTERPRIS/offers"
    },
    "vendor": "MSCSP"
  }
}
JSON;

        $this->curler->expects(self::once())
            ->method('get')
            ->with('https://www.test.com/catalog/categories/SAAS/programs/microsoft/products/MS-0B-O365-ENTERPRIS');

        $service = $this->client->getService('SAAS', 'microsoft', 'MS-0B-O365-ENTERPRIS');

        self::assertEquals('Office 365 Enterprise – (Corporate)', $service->getName());
        self::assertEquals('SAAS', $service->getClassification());
        self::assertEquals('MSCSP', $service->getAssociatedSubscriptionProgram());
        self::assertEquals('MS-0B-O365-ENTERPRIS', $service->getReference());
        self::assertEquals('Each Dynamics 365 Customer Voice add-on provides access to...', $service->getDescription());
        self::assertEquals('Microsoft', $service->getProgram());
        self::assertEquals(['Productivity'], $service->getServiceTags());
    }
}
