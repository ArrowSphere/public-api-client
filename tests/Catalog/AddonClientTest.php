<?php

namespace ArrowSphere\PublicApiClient\Tests\Catalog;

use ArrowSphere\PublicApiClient\Catalog\AddonClient;
use ArrowSphere\PublicApiClient\Catalog\Entities\Offer;
use ArrowSphere\PublicApiClient\Catalog\Entities\PriceBand;
use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use ArrowSphere\PublicApiClient\Tests\AbstractClientTest;
use GuzzleHttp\Psr7\Response;

/**
 * Class AddonClientTest
 *
 * @property AddonClient $client
 */
class AddonClientTest extends AbstractClientTest
{
    protected const MOCKED_CLIENT_CLASS = AddonClient::class;

    /**
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function testGetAddonsRaw(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/catalog/categories/SAAS/programs/microsoft/products/MS-1A-M365-ENT/offers/05933B83-04D1-4AC6-BFCD-DBBBFC834483/addons')
            ->willReturn(new Response(200, [], 'OK USA'));

        $this->client->getAddonsRaw('SAAS', 'microsoft', 'MS-1A-M365-ENT', '05933B83-04D1-4AC6-BFCD-DBBBFC834483');
    }

    /**
     * @depends testGetAddonsRaw
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function testGetAddonsWithInvalidResponse(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/catalog/categories/SAAS/programs/microsoft/products/MS-1A-M365-ENT/offers/05933B83-04D1-4AC6-BFCD-DBBBFC834483/addons?per_page=100')
            ->willReturn(new Response(200, [], '{'));

        $this->expectException(PublicApiClientException::class);
        $addons = $this->client->getAddons('SAAS', 'microsoft', 'MS-1A-M365-ENT', '05933B83-04D1-4AC6-BFCD-DBBBFC834483');
        iterator_to_array($addons);
    }

    /**
     * @depends testGetAddonsRaw
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function testGetAddonsWithPagination(): void
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
                ['get', 'https://www.test.com/catalog/categories/SAAS/programs/microsoft/products/MS-1A-M365-ENT/offers/05933B83-04D1-4AC6-BFCD-DBBBFC834483/addons?per_page=100'],
                ['get', 'https://www.test.com/catalog/categories/SAAS/programs/microsoft/products/MS-1A-M365-ENT/offers/05933B83-04D1-4AC6-BFCD-DBBBFC834483/addons?page=2&per_page=100'],
                ['get', 'https://www.test.com/catalog/categories/SAAS/programs/microsoft/products/MS-1A-M365-ENT/offers/05933B83-04D1-4AC6-BFCD-DBBBFC834483/addons?page=3&per_page=100']
            )
            ->willReturn(new Response(200, [], $response));

        $test = $this->client->getAddons('SAAS', 'microsoft', 'MS-1A-M365-ENT', '05933B83-04D1-4AC6-BFCD-DBBBFC834483');
        iterator_to_array($test);
    }

    /**
     * @depends testGetAddonsRaw
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function testGetAddons(): void
    {
        $response = <<<JSON
{
  "status": 200,
  "data": [
    {
      "reference": "05933B83-04D1-4AC6-BFCD-DBBBFC834483",
      "name": "Business Apps (free)",
      "associatedSubscriptionProgram": "MSCSP",
      "vendor": "Microsoft",
      "description": "description",
      "hasAddon": false,
      "isAddon": true,
      "isTrial": false,
      "product": "MS-1A-M365-ENT",
      "program": "microsoft",
      "category": "SAAS",
      "orderableSku": "U0FBU3x8bWljcm9zb2Z0fHxNUy0wWkYtU0tZUEUtT05MSU5FfHw4QkRCQjYwQi1FNTI2LTQzRTktOTJFRi1BQjc2MEM4RTBCNzJ8fDA1OTMzQjgzLTA0RDEtNEFDNi1CRkNELURCQkJGQzgzNDQ4Mw==",
      "prices": [
        {
          "min_quantity": 1,
          "max_quantity": 10000000,
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
          "max_quantity": 10000000,
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
      "buyingProgram": "Corporate",
      "buyingType": "PAYGO",
      "endUserEula": "end user eula",
      "endUserFeatures": "end user features",
      "endUserRequirements": "end user requirements",
      "links": {
        "program": "/api/catalog/categories/SAAS/programs/microsoft",
        "product": "/api/catalog/categories/SAAS/programs/microsoft/products/MS-1A-M365-ENT",
        "offer": "/api/catalog/categories/SAAS/programs/microsoft/products/MS-1A-M365-ENT/offers/05933B83-04D1-4AC6-BFCD-DBBBFC834483"
      },
      "addonParents": [
        "02C07B64-2CD3-4667-B014-561192FC5D1A"
      ],
      "logo": "https://websource.myportal.cloud/images/Microsoft.png",
      "icon": "https://websource.myportal.cloud/images/icon/Microsoft.png",
      "offer": "8BDBB60B-E526-43E9-92EF-AB760C8E0B72"
    },
    {
      "reference": "0F598EFE-F330-4D79-B79F-C9480BB7CE3E",
      "name": "Microsoft 365 Domestic Calling Plan",
      "associatedSubscriptionProgram": "MSCSP",
      "vendor": "Microsoft",
      "description": "description",
      "hasAddon": true,
      "isAddon": true,
      "isTrial": false,
      "product": "MS-1A-M365-ENT",
      "program": "microsoft",
      "category": "SAAS",
      "orderableSku": "U0FBU3x8bWljcm9zb2Z0fHxNUy1TS1ktRkItUFNUTi1BRERPTnx8OEJEQkI2MEItRTUyNi00M0U5LTkyRUYtQUI3NjBDOEUwQjcyfHwwRjU5OEVGRS1GMzMwLTRENzktQjc5Ri1DOTQ4MEJCN0NFM0U=",
      "prices": [
        {
          "min_quantity": 1,
          "max_quantity": 10000000,
          "recurring_buy_price": 10,
          "recurring_sell_price": 12,
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
          "max_quantity": 10000000,
          "recurring_buy_price": 110,
          "recurring_sell_price": 130,
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
      "buyingProgram": "Corporate",
      "buyingType": "PAYGO",
      "endUserEula": "end user eula",
      "endUserFeatures": "end user features",
      "endUserRequirements": "end user requirements",
      "links": {
        "program": "/api/catalog/categories/SAAS/programs/microsoft",
        "product": "/api/catalog/categories/SAAS/programs/microsoft/products/MS-1A-M365-ENT",
        "offer": "/api/catalog/categories/SAAS/programs/microsoft/products/MS-1A-M365-ENT/offers/0F598EFE-F330-4D79-B79F-C9480BB7CE3E",
        "addons": "/api/catalog/categories/SAAS/programs/microsoft/products/MS-1A-M365-ENT/offers/0F598EFE-F330-4D79-B79F-C9480BB7CE3E/addons"
      },
      "addonParents": [
        "02C07B64-2CD3-4667-B014-561192FC5D1A"
      ],
      "logo": "https://websource.myportal.cloud/images/Microsoft.png",
      "icon": "https://websource.myportal.cloud/images/icon/Microsoft.png",
      "offer": "8BDBB60B-E526-43E9-92EF-AB760C8E0B72"
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
            ->with('get', 'https://www.test.com/catalog/categories/SAAS/programs/microsoft/products/MS-1A-M365-ENT/offers/05933B83-04D1-4AC6-BFCD-DBBBFC834483/addons?per_page=100')
            ->willReturn(new Response(200, [], $response));

        $test = $this->client->getAddons('SAAS', 'microsoft', 'MS-1A-M365-ENT', '05933B83-04D1-4AC6-BFCD-DBBBFC834483');
        $list = iterator_to_array($test);
        self::assertCount(2, $list);

        /** @var Offer $addon */
        $addon = array_shift($list);
        self::assertInstanceOf(Offer::class, $addon);
        self::assertEquals('description', $addon->getDescription());
        self::assertEquals('SAAS', $addon->getClassification());
        self::assertEquals('Business Apps (free)', $addon->getName());
        self::assertEquals([], $addon->getKeywords());
        self::assertEquals('', $addon->getFullFeatures());
        self::assertEquals('', $addon->getShortFeatures());
        self::assertNull($addon->getEula());
        self::assertEquals('', $addon->getFeaturesPicture());
        self::assertEquals('Corporate', $addon->getBuyingProgram());
        self::assertEquals(["02C07B64-2CD3-4667-B014-561192FC5D1A"], $addon->getPrerequisites());
        self::assertEquals('', $addon->getConversionSkus());
        self::assertFalse($addon->getIsTrial());
        self::assertTrue($addon->getIsAddon());
        self::assertFalse($addon->getHasAddons());
        self::assertEquals('microsoft', $addon->getVendorCode());
        self::assertEquals('Microsoft', $addon->getVendor());
        self::assertEquals('05933B83-04D1-4AC6-BFCD-DBBBFC834483', $addon->getSku());
        self::assertEquals('MS-1A-M365-ENT', $addon->getServiceRef());
        self::assertEquals([], $addon->getCategory());
        self::assertTrue($addon->getIsEnabled());
        self::assertEquals('', $addon->getRequirements());
        self::assertEquals(0, $addon->getWeightForced());
        self::assertEquals(0, $addon->getWeightTopSales());
        self::assertEquals('', $addon->getCustomerCategory());
        self::assertEquals('end user features', $addon->getEndCustomerFeatures());
        self::assertEquals('', $addon->getThumbnail());
        self::assertEquals('', $addon->getServiceDescription());
        self::assertEquals('', $addon->getServiceName());
        self::assertEquals('N/A', $addon->getMarketplace());
        self::assertEquals('U0FBU3x8bWljcm9zb2Z0fHxNUy0wWkYtU0tZUEUtT05MSU5FfHw4QkRCQjYwQi1FNTI2LTQzRTktOTJFRi1BQjc2MEM4RTBCNzJ8fDA1OTMzQjgzLTA0RDEtNEFDNi1CRkNELURCQkJGQzgzNDQ4Mw==', $addon->getOrderableSku());
        self::assertTrue($addon->getProgramIsEnabled());

        $priceBands = $addon->getPriceBands();
        self::assertCount(2, $priceBands);

        $priceBand = array_shift($priceBands);
        self::assertInstanceOf(PriceBand::class, $priceBand);
        self::assertEquals(1, $priceBand->getMinQuantity());
        self::assertEquals(10000000, $priceBand->getMaxQuantity());
        self::assertEquals(0, $priceBand->getRecurringBuyPrice());
        self::assertEquals(0, $priceBand->getRecurringSellPrice());
        self::assertNull($priceBand->getArrowPrice());
        self::assertEquals('1 Year', $priceBand->getTerm());
        self::assertEquals('LICENSE', $priceBand->getUnitType());
        self::assertEquals('per Month', $priceBand->getRecurringTimeUnit());
        self::assertEquals('USD', $priceBand->getCurrency());
        self::assertEquals(720, $priceBand->getPeriodAsHours());
        self::assertEquals(8640, $priceBand->getTermAsHours());

        $priceBand = array_shift($priceBands);
        self::assertInstanceOf(PriceBand::class, $priceBand);
        self::assertEquals(1, $priceBand->getMinQuantity());
        self::assertEquals(10000000, $priceBand->getMaxQuantity());
        self::assertEquals(0, $priceBand->getRecurringBuyPrice());
        self::assertEquals(0, $priceBand->getRecurringSellPrice());
        self::assertNull($priceBand->getArrowPrice());
        self::assertEquals('1 Year', $priceBand->getTerm());
        self::assertEquals('LICENSE', $priceBand->getUnitType());
        self::assertEquals('per Year', $priceBand->getRecurringTimeUnit());
        self::assertEquals('USD', $priceBand->getCurrency());
        self::assertEquals(8640, $priceBand->getPeriodAsHours());
        self::assertEquals(8640, $priceBand->getTermAsHours());

        /** @var Offer $addon */
        $addon = array_shift($list);
        self::assertInstanceOf(Offer::class, $addon);
        self::assertEquals('description', $addon->getDescription());
        self::assertEquals('SAAS', $addon->getClassification());
        self::assertEquals('Microsoft 365 Domestic Calling Plan', $addon->getName());
        self::assertEquals([], $addon->getKeywords());
        self::assertEquals('', $addon->getFullFeatures());
        self::assertEquals('', $addon->getShortFeatures());
        self::assertNull($addon->getEula());
        self::assertEquals('', $addon->getFeaturesPicture());
        self::assertEquals('Corporate', $addon->getBuyingProgram());
        self::assertEquals(["02C07B64-2CD3-4667-B014-561192FC5D1A"], $addon->getPrerequisites());
        self::assertEquals('', $addon->getConversionSkus());
        self::assertFalse($addon->getIsTrial());
        self::assertTrue($addon->getIsAddon());
        self::assertTrue($addon->getHasAddons());
        self::assertEquals('microsoft', $addon->getVendorCode());
        self::assertEquals('Microsoft', $addon->getVendor());
        self::assertEquals('0F598EFE-F330-4D79-B79F-C9480BB7CE3E', $addon->getSku());
        self::assertEquals('MS-1A-M365-ENT', $addon->getServiceRef());
        self::assertEquals([], $addon->getCategory());
        self::assertTrue($addon->getIsEnabled());
        self::assertEquals('', $addon->getRequirements());
        self::assertEquals(0, $addon->getWeightForced());
        self::assertEquals(0, $addon->getWeightTopSales());
        self::assertEquals('', $addon->getCustomerCategory());
        self::assertEquals('end user features', $addon->getEndCustomerFeatures());
        self::assertEquals('', $addon->getThumbnail());
        self::assertEquals('', $addon->getServiceDescription());
        self::assertEquals('', $addon->getServiceName());
        self::assertEquals('N/A', $addon->getMarketplace());
        self::assertEquals('U0FBU3x8bWljcm9zb2Z0fHxNUy1TS1ktRkItUFNUTi1BRERPTnx8OEJEQkI2MEItRTUyNi00M0U5LTkyRUYtQUI3NjBDOEUwQjcyfHwwRjU5OEVGRS1GMzMwLTRENzktQjc5Ri1DOTQ4MEJCN0NFM0U=', $addon->getOrderableSku());
        self::assertTrue($addon->getProgramIsEnabled());

        $priceBands = $addon->getPriceBands();
        self::assertCount(2, $priceBands);

        $priceBand = array_shift($priceBands);
        self::assertInstanceOf(PriceBand::class, $priceBand);
        self::assertEquals(1, $priceBand->getMinQuantity());
        self::assertEquals(10000000, $priceBand->getMaxQuantity());
        self::assertEquals(10, $priceBand->getRecurringBuyPrice());
        self::assertEquals(12, $priceBand->getRecurringSellPrice());
        self::assertNull($priceBand->getArrowPrice());
        self::assertEquals('1 Year', $priceBand->getTerm());
        self::assertEquals('LICENSE', $priceBand->getUnitType());
        self::assertEquals('per Month', $priceBand->getRecurringTimeUnit());
        self::assertEquals('USD', $priceBand->getCurrency());
        self::assertEquals(720, $priceBand->getPeriodAsHours());
        self::assertEquals(8640, $priceBand->getTermAsHours());

        $priceBand = array_shift($priceBands);
        self::assertInstanceOf(PriceBand::class, $priceBand);
        self::assertEquals(1, $priceBand->getMinQuantity());
        self::assertEquals(10000000, $priceBand->getMaxQuantity());
        self::assertEquals(110, $priceBand->getRecurringBuyPrice());
        self::assertEquals(130, $priceBand->getRecurringSellPrice());
        self::assertNull($priceBand->getArrowPrice());
        self::assertEquals('1 Year', $priceBand->getTerm());
        self::assertEquals('LICENSE', $priceBand->getUnitType());
        self::assertEquals('per Year', $priceBand->getRecurringTimeUnit());
        self::assertEquals('USD', $priceBand->getCurrency());
        self::assertEquals(8640, $priceBand->getPeriodAsHours());
        self::assertEquals(8640, $priceBand->getTermAsHours());
    }

    /**
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function testGetAddonRaw(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/catalog/categories/SAAS/programs/microsoft/products/MS-1A-M365-ENT/offers/05933B83-04D1-4AC6-BFCD-DBBBFC834483/addons/0F598EFE-F330-4D79-B79F-C9480BB7CE3E')
            ->willReturn(new Response(200, [], 'OK USA'));

        $this->client->getAddonRaw('SAAS', 'microsoft', 'MS-1A-M365-ENT', '05933B83-04D1-4AC6-BFCD-DBBBFC834483', '0F598EFE-F330-4D79-B79F-C9480BB7CE3E');
    }

    /**
     * @depends testGetAddonRaw
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function testGetAddonWithInvalidResponse(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/catalog/categories/SAAS/programs/microsoft/products/MS-1A-M365-ENT/offers/05933B83-04D1-4AC6-BFCD-DBBBFC834483/addons/0F598EFE-F330-4D79-B79F-C9480BB7CE3E')
            ->willReturn(new Response(200, [], '{'));

        $this->expectException(PublicApiClientException::class);
        $this->client->getAddon('SAAS', 'microsoft', 'MS-1A-M365-ENT', '05933B83-04D1-4AC6-BFCD-DBBBFC834483', '0F598EFE-F330-4D79-B79F-C9480BB7CE3E');
    }

    /**
     * @depends testGetAddonRaw
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function testGetAddon(): void
    {
        $response = <<<JSON
{
  "status": 200,
  "data": {
    "reference": "0F598EFE-F330-4D79-B79F-C9480BB7CE3E",
    "name": "Microsoft 365 Domestic Calling Plan",
    "associatedSubscriptionProgram": "MSCSP",
    "vendor": "Microsoft",
    "description": "description",
    "hasAddon": true,
    "isAddon": true,
    "isTrial": false,
    "product": "MS-1A-M365-ENT",
    "program": "microsoft",
    "category": "SAAS",
    "orderableSku": "U0FBU3x8bWljcm9zb2Z0fHxNUy1TS1ktRkItUFNUTi1BRERPTnx8OEJEQkI2MEItRTUyNi00M0U5LTkyRUYtQUI3NjBDOEUwQjcyfHwwRjU5OEVGRS1GMzMwLTRENzktQjc5Ri1DOTQ4MEJCN0NFM0U=",
    "prices": [
      {
        "min_quantity": 1,
        "max_quantity": 10000000,
        "recurring_buy_price": 10,
        "recurring_sell_price": 12,
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
        "max_quantity": 10000000,
        "recurring_buy_price": 110,
        "recurring_sell_price": 130,
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
    "buyingProgram": "Corporate",
    "buyingType": "PAYGO",
    "endUserEula": "end user eula",
    "endUserFeatures": "end user features",
    "endUserRequirements": "end user requirements",
    "links": {
      "program": "/api/catalog/categories/SAAS/programs/microsoft",
      "product": "/api/catalog/categories/SAAS/programs/microsoft/products/MS-1A-M365-ENT",
      "offer": "/api/catalog/categories/SAAS/programs/microsoft/products/MS-1A-M365-ENT/offers/0F598EFE-F330-4D79-B79F-C9480BB7CE3E",
      "addons": "/api/catalog/categories/SAAS/programs/microsoft/products/MS-1A-M365-ENT/offers/0F598EFE-F330-4D79-B79F-C9480BB7CE3E/addons"
    },
    "addonParents": [
      "02C07B64-2CD3-4667-B014-561192FC5D1A"
    ],
    "logo": "https://websource.myportal.cloud/images/Microsoft.png",
    "icon": "https://websource.myportal.cloud/images/icon/Microsoft.png",
    "offer": "8BDBB60B-E526-43E9-92EF-AB760C8E0B72"
  }
}
JSON;
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/catalog/categories/SAAS/programs/microsoft/products/MS-1A-M365-ENT/offers/05933B83-04D1-4AC6-BFCD-DBBBFC834483/addons/0F598EFE-F330-4D79-B79F-C9480BB7CE3E')
            ->willReturn(new Response(200, [], $response));

        $addon = $this->client->getAddon('SAAS', 'microsoft', 'MS-1A-M365-ENT', '05933B83-04D1-4AC6-BFCD-DBBBFC834483', '0F598EFE-F330-4D79-B79F-C9480BB7CE3E');
        self::assertEquals('description', $addon->getDescription());
        self::assertEquals('SAAS', $addon->getClassification());
        self::assertEquals('Microsoft 365 Domestic Calling Plan', $addon->getName());
        self::assertEquals([], $addon->getAddons());
        self::assertEquals(["02C07B64-2CD3-4667-B014-561192FC5D1A"], $addon->getPrerequisites());

        self::assertEquals([], $addon->getKeywords());
        self::assertEquals('', $addon->getFullFeatures());
        self::assertEquals('', $addon->getShortFeatures());
        self::assertNull($addon->getEula());
        self::assertEquals('', $addon->getFeaturesPicture());
        self::assertEquals('Corporate', $addon->getBuyingProgram());
        self::assertEquals(["02C07B64-2CD3-4667-B014-561192FC5D1A"], $addon->getPrerequisites());
        self::assertEquals('', $addon->getConversionSkus());
        self::assertFalse($addon->getIsTrial());
        self::assertTrue($addon->getIsAddon());
        self::assertTrue($addon->getHasAddons());
        self::assertEquals('microsoft', $addon->getVendorCode());
        self::assertEquals('Microsoft', $addon->getVendor());
        self::assertEquals('0F598EFE-F330-4D79-B79F-C9480BB7CE3E', $addon->getSku());
        self::assertEquals('MS-1A-M365-ENT', $addon->getServiceRef());
        self::assertEquals([], $addon->getCategory());
        self::assertTrue($addon->getIsEnabled());
        self::assertEquals('', $addon->getRequirements());
        self::assertEquals(0, $addon->getWeightForced());
        self::assertEquals(0, $addon->getWeightTopSales());
        self::assertEquals('', $addon->getCustomerCategory());
        self::assertEquals('end user features', $addon->getEndCustomerFeatures());
        self::assertEquals('', $addon->getThumbnail());
        self::assertEquals('', $addon->getServiceDescription());
        self::assertEquals('', $addon->getServiceName());
        self::assertEquals('N/A', $addon->getMarketplace());
        self::assertEquals('U0FBU3x8bWljcm9zb2Z0fHxNUy1TS1ktRkItUFNUTi1BRERPTnx8OEJEQkI2MEItRTUyNi00M0U5LTkyRUYtQUI3NjBDOEUwQjcyfHwwRjU5OEVGRS1GMzMwLTRENzktQjc5Ri1DOTQ4MEJCN0NFM0U=', $addon->getOrderableSku());
        self::assertTrue($addon->getProgramIsEnabled());

        $priceBands = $addon->getPriceBands();
        self::assertCount(2, $priceBands);

        $priceBand = array_shift($priceBands);
        self::assertInstanceOf(PriceBand::class, $priceBand);
        self::assertEquals(1, $priceBand->getMinQuantity());
        self::assertEquals(10000000, $priceBand->getMaxQuantity());
        self::assertEquals(10, $priceBand->getRecurringBuyPrice());
        self::assertEquals(12, $priceBand->getRecurringSellPrice());
        self::assertNull($priceBand->getArrowPrice());
        self::assertEquals('1 Year', $priceBand->getTerm());
        self::assertEquals('LICENSE', $priceBand->getUnitType());
        self::assertEquals('per Month', $priceBand->getRecurringTimeUnit());
        self::assertEquals('USD', $priceBand->getCurrency());
        self::assertEquals(720, $priceBand->getPeriodAsHours());
        self::assertEquals(8640, $priceBand->getTermAsHours());

        $priceBand = array_shift($priceBands);
        self::assertInstanceOf(PriceBand::class, $priceBand);
        self::assertEquals(1, $priceBand->getMinQuantity());
        self::assertEquals(10000000, $priceBand->getMaxQuantity());
        self::assertEquals(110, $priceBand->getRecurringBuyPrice());
        self::assertEquals(130, $priceBand->getRecurringSellPrice());
        self::assertNull($priceBand->getArrowPrice());
        self::assertEquals('1 Year', $priceBand->getTerm());
        self::assertEquals('LICENSE', $priceBand->getUnitType());
        self::assertEquals('per Year', $priceBand->getRecurringTimeUnit());
        self::assertEquals('USD', $priceBand->getCurrency());
        self::assertEquals(8640, $priceBand->getPeriodAsHours());
        self::assertEquals(8640, $priceBand->getTermAsHours());
    }
}
