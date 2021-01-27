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
            ->method('get')
            ->with('https://www.test.com/catalog/categories/SAAS/programs/microsoft/products/MS-1A-M365-ENT/offers/05933B83-04D1-4AC6-BFCD-DBBBFC834483/addons')
            ->willReturn(new Response(200, [], 'OK USA'));

        $this->client->getAddonsRaw('SAAS', 'microsoft', 'MS-1A-M365-ENT', '05933B83-04D1-4AC6-BFCD-DBBBFC834483');
    }

    /**
     * @depends testGetAddonsRaw
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function testGetAddonsWithInvalidResponse(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('get')
            ->with('https://www.test.com/catalog/categories/SAAS/programs/microsoft/products/MS-1A-M365-ENT/offers/05933B83-04D1-4AC6-BFCD-DBBBFC834483/addons?per_page=100')
            ->willReturn(new Response(200, [], '{'));

        $this->expectException(PublicApiClientException::class);
        $addons = $this->client->getAddons('SAAS', 'microsoft', 'MS-1A-M365-ENT', '05933B83-04D1-4AC6-BFCD-DBBBFC834483');
        iterator_to_array($addons);
    }

    /**
     * @depends testGetAddonsRaw
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
            ->method('get')
            ->withConsecutive(
                ['https://www.test.com/catalog/categories/SAAS/programs/microsoft/products/MS-1A-M365-ENT/offers/05933B83-04D1-4AC6-BFCD-DBBBFC834483/addons?per_page=100'],
                ['https://www.test.com/catalog/categories/SAAS/programs/microsoft/products/MS-1A-M365-ENT/offers/05933B83-04D1-4AC6-BFCD-DBBBFC834483/addons?page=2&per_page=100'],
                ['https://www.test.com/catalog/categories/SAAS/programs/microsoft/products/MS-1A-M365-ENT/offers/05933B83-04D1-4AC6-BFCD-DBBBFC834483/addons?page=3&per_page=100']
            )
            ->willReturn(new Response(200, [], $response));

        $test = $this->client->getAddons('SAAS', 'microsoft', 'MS-1A-M365-ENT', '05933B83-04D1-4AC6-BFCD-DBBBFC834483');
        iterator_to_array($test);
    }

    /**
     * @depends testGetAddonsRaw
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
        "02C07B64-2CD3-4667-B014-561192FC5D1A",
        "096FABDF-AEB1-43DB-B04B-FF453B0AFADC",
        "0F797C58-3B74-40A8-BFA5-383440A99445",
        "11D802D5-4295-44D5-B355-8EAFB184EF36",
        "1A6E8918-D2B2-432D-83A6-68C16C5D408E",
        "2B3B8D2D-10AA-4BE4-B5FD-7F2FEB0C3091",
        "2F192EFE-608A-4C9C-9D19-2B0B70B0962E",
        "31BEDF01-9E57-4ECE-A53A-D3656A563931",
        "32B23C88-949F-4E5B-B500-A87EEC676B80",
        "43EE8060-1930-4F17-A01B-9B3A296C6824",
        "4F7ECAF1-E9D6-4CAC-9687-E22EB3DFDD70",
        "64168B63-4BCC-41E0-B5CB-7DC548977620",
        "6B551829-DE8C-41E5-8678-41D52C27AEE8",
        "796B6B5F-613C-4E24-A17C-EBA730D49C02",
        "8BA3FD99-CD7C-48B0-811B-E78F7A4A1B32",
        "8BDBB60B-E526-43E9-92EF-AB760C8E0B72",
        "96D36E53-7E42-4CA3-AE96-BD20E3098D8D",
        "A044B16A-1861-4308-8086-A3A3B506FAC2",
        "B456810A-C414-4E07-98FC-EF74E8175A09",
        "C2CAA762-83F8-43C4-ACEC-ECAD58B69D1B",
        "C3897426-9F49-4EAF-9B4D-7D9A1C72AEF7",
        "C4158AA7-00E7-4CE1-9CF3-3CF8321F377A",
        "CE139FE5-8BD5-47ED-A5BE-07C286F8B9E0",
        "D27F14DF-AECE-49BD-B769-D4E28A24963E",
        "DB5E0B1C-9CC3-459C-9D08-C61993959FD3",
        "E016B974-A412-404F-98CD-DB92311AFB10",
        "E9025A44-59B1-497B-A5BE-F148006549BA",
        "F7AD4EAF-F2EF-42DC-B43C-425CE393435C"
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
        "02C07B64-2CD3-4667-B014-561192FC5D1A",
        "096FABDF-AEB1-43DB-B04B-FF453B0AFADC",
        "0F797C58-3B74-40A8-BFA5-383440A99445",
        "11D802D5-4295-44D5-B355-8EAFB184EF36",
        "2C883339-EF9C-4CCE-81B8-E5ADEA60794C",
        "2F192EFE-608A-4C9C-9D19-2B0B70B0962E",
        "31BEDF01-9E57-4ECE-A53A-D3656A563931",
        "4260988E-990D-479C-AE7B-F01CE8E1BB4D",
        "4D8F3B90-29B3-4E7B-B37C-4A435DDEF1D9",
        "4F7ECAF1-E9D6-4CAC-9687-E22EB3DFDD70",
        "64168B63-4BCC-41E0-B5CB-7DC548977620",
        "8A93D724-50EF-4293-B4F7-B28536DC3101",
        "8BA3FD99-CD7C-48B0-811B-E78F7A4A1B32",
        "8BDBB60B-E526-43E9-92EF-AB760C8E0B72",
        "96D36E53-7E42-4CA3-AE96-BD20E3098D8D",
        "A044B16A-1861-4308-8086-A3A3B506FAC2",
        "B456810A-C414-4E07-98FC-EF74E8175A09",
        "B9A1D576-43FD-464B-8AD9-4B1EAFC5DB77",
        "C2CAA762-83F8-43C4-ACEC-ECAD58B69D1B",
        "C3897426-9F49-4EAF-9B4D-7D9A1C72AEF7",
        "C4158AA7-00E7-4CE1-9CF3-3CF8321F377A",
        "CE139FE5-8BD5-47ED-A5BE-07C286F8B9E0",
        "D6985A19-C58D-4352-88AE-9095D2FE8736",
        "DB5E0B1C-9CC3-459C-9D08-C61993959FD3",
        "DD08DAA2-BC6A-4BC6-A388-AE36118EFCA0",
        "E016B974-A412-404F-98CD-DB92311AFB10"
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
            ->method('get')
            ->with('https://www.test.com/catalog/categories/SAAS/programs/microsoft/products/MS-1A-M365-ENT/offers/05933B83-04D1-4AC6-BFCD-DBBBFC834483/addons?per_page=100')
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
        self::assertEquals(null, $addon->getEula());
        self::assertEquals('', $addon->getFeaturesPicture());
        self::assertEquals('Corporate', $addon->getBuyingProgram());
        self::assertEquals(null, $addon->getPrerequisites());
        self::assertEquals('', $addon->getConversionSkus());
        self::assertEquals(false, $addon->getIsTrial());
        self::assertEquals(true, $addon->getIsAddon());
        self::assertEquals(false, $addon->getHasAddons());
        self::assertEquals('microsoft', $addon->getVendorCode());
        self::assertEquals('Microsoft', $addon->getVendor());
        self::assertEquals('05933B83-04D1-4AC6-BFCD-DBBBFC834483', $addon->getSku());
        self::assertEquals('MS-1A-M365-ENT', $addon->getServiceRef());
        self::assertEquals([], $addon->getCategory());
        self::assertEquals(true, $addon->getIsEnabled());
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
        self::assertEquals(true, $addon->getProgramIsEnabled());

        $priceBands = $addon->getPriceBands();
        self::assertCount(2, $priceBands);

        $priceBand = array_shift($priceBands);
        self::assertInstanceOf(PriceBand::class, $priceBand);
        self::assertEquals(1, $priceBand->getMinQuantity());
        self::assertEquals(10000000, $priceBand->getMaxQuantity());
        self::assertEquals(0, $priceBand->getRecurringBuyPrice());
        self::assertEquals(0, $priceBand->getRecurringSellPrice());
        self::assertEquals(null, $priceBand->getArrowPrice());
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
        self::assertEquals(null, $priceBand->getArrowPrice());
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
        self::assertEquals(null, $addon->getEula());
        self::assertEquals('', $addon->getFeaturesPicture());
        self::assertEquals('Corporate', $addon->getBuyingProgram());
        self::assertEquals(null, $addon->getPrerequisites());
        self::assertEquals('', $addon->getConversionSkus());
        self::assertEquals(false, $addon->getIsTrial());
        self::assertEquals(true, $addon->getIsAddon());
        self::assertEquals(true, $addon->getHasAddons());
        self::assertEquals('microsoft', $addon->getVendorCode());
        self::assertEquals('Microsoft', $addon->getVendor());
        self::assertEquals('0F598EFE-F330-4D79-B79F-C9480BB7CE3E', $addon->getSku());
        self::assertEquals('MS-1A-M365-ENT', $addon->getServiceRef());
        self::assertEquals([], $addon->getCategory());
        self::assertEquals(true, $addon->getIsEnabled());
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
        self::assertEquals(true, $addon->getProgramIsEnabled());

        $priceBands = $addon->getPriceBands();
        self::assertCount(2, $priceBands);

        $priceBand = array_shift($priceBands);
        self::assertInstanceOf(PriceBand::class, $priceBand);
        self::assertEquals(1, $priceBand->getMinQuantity());
        self::assertEquals(10000000, $priceBand->getMaxQuantity());
        self::assertEquals(10, $priceBand->getRecurringBuyPrice());
        self::assertEquals(12, $priceBand->getRecurringSellPrice());
        self::assertEquals(null, $priceBand->getArrowPrice());
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
        self::assertEquals(null, $priceBand->getArrowPrice());
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
            ->method('get')
            ->with('https://www.test.com/catalog/categories/SAAS/programs/microsoft/products/MS-1A-M365-ENT/offers/05933B83-04D1-4AC6-BFCD-DBBBFC834483/addons/0F598EFE-F330-4D79-B79F-C9480BB7CE3E')
            ->willReturn(new Response(200, [], 'OK USA'));

        $this->client->getAddonRaw('SAAS', 'microsoft', 'MS-1A-M365-ENT', '05933B83-04D1-4AC6-BFCD-DBBBFC834483', '0F598EFE-F330-4D79-B79F-C9480BB7CE3E');
    }

    /**
     * @depends testGetAddonRaw
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function testGetAddonWithInvalidResponse(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('get')
            ->with('https://www.test.com/catalog/categories/SAAS/programs/microsoft/products/MS-1A-M365-ENT/offers/05933B83-04D1-4AC6-BFCD-DBBBFC834483/addons/0F598EFE-F330-4D79-B79F-C9480BB7CE3E')
            ->willReturn(new Response(200, [], '{'));

        $this->expectException(PublicApiClientException::class);
        $this->client->getAddon('SAAS', 'microsoft', 'MS-1A-M365-ENT', '05933B83-04D1-4AC6-BFCD-DBBBFC834483', '0F598EFE-F330-4D79-B79F-C9480BB7CE3E');
    }

    /**
     * @depends testGetAddonRaw
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
      "02C07B64-2CD3-4667-B014-561192FC5D1A",
      "096FABDF-AEB1-43DB-B04B-FF453B0AFADC",
      "0F797C58-3B74-40A8-BFA5-383440A99445",
      "11D802D5-4295-44D5-B355-8EAFB184EF36",
      "2C883339-EF9C-4CCE-81B8-E5ADEA60794C",
      "2F192EFE-608A-4C9C-9D19-2B0B70B0962E",
      "31BEDF01-9E57-4ECE-A53A-D3656A563931",
      "4260988E-990D-479C-AE7B-F01CE8E1BB4D",
      "4D8F3B90-29B3-4E7B-B37C-4A435DDEF1D9",
      "4F7ECAF1-E9D6-4CAC-9687-E22EB3DFDD70",
      "64168B63-4BCC-41E0-B5CB-7DC548977620",
      "8A93D724-50EF-4293-B4F7-B28536DC3101",
      "8BA3FD99-CD7C-48B0-811B-E78F7A4A1B32",
      "8BDBB60B-E526-43E9-92EF-AB760C8E0B72",
      "96D36E53-7E42-4CA3-AE96-BD20E3098D8D",
      "A044B16A-1861-4308-8086-A3A3B506FAC2",
      "B456810A-C414-4E07-98FC-EF74E8175A09",
      "B9A1D576-43FD-464B-8AD9-4B1EAFC5DB77",
      "C2CAA762-83F8-43C4-ACEC-ECAD58B69D1B",
      "C3897426-9F49-4EAF-9B4D-7D9A1C72AEF7",
      "C4158AA7-00E7-4CE1-9CF3-3CF8321F377A",
      "CE139FE5-8BD5-47ED-A5BE-07C286F8B9E0",
      "D6985A19-C58D-4352-88AE-9095D2FE8736",
      "DB5E0B1C-9CC3-459C-9D08-C61993959FD3",
      "DD08DAA2-BC6A-4BC6-A388-AE36118EFCA0",
      "E016B974-A412-404F-98CD-DB92311AFB10"
    ],
    "logo": "https://websource.myportal.cloud/images/Microsoft.png",
    "icon": "https://websource.myportal.cloud/images/icon/Microsoft.png",
    "offer": "8BDBB60B-E526-43E9-92EF-AB760C8E0B72"
  }
}
JSON;
        $this->httpClient
            ->expects(self::once())
            ->method('get')
            ->with('https://www.test.com/catalog/categories/SAAS/programs/microsoft/products/MS-1A-M365-ENT/offers/05933B83-04D1-4AC6-BFCD-DBBBFC834483/addons/0F598EFE-F330-4D79-B79F-C9480BB7CE3E')
            ->willReturn(new Response(200, [], $response));

        $addon = $this->client->getAddon('SAAS', 'microsoft', 'MS-1A-M365-ENT', '05933B83-04D1-4AC6-BFCD-DBBBFC834483', '0F598EFE-F330-4D79-B79F-C9480BB7CE3E');
        self::assertEquals('description', $addon->getDescription());
        self::assertEquals('SAAS', $addon->getClassification());
        self::assertEquals('Microsoft 365 Domestic Calling Plan', $addon->getName());
        self::assertEquals([], $addon->getKeywords());
        self::assertEquals('', $addon->getFullFeatures());
        self::assertEquals('', $addon->getShortFeatures());
        self::assertEquals(null, $addon->getEula());
        self::assertEquals('', $addon->getFeaturesPicture());
        self::assertEquals('Corporate', $addon->getBuyingProgram());
        self::assertEquals(null, $addon->getPrerequisites());
        self::assertEquals('', $addon->getConversionSkus());
        self::assertEquals(false, $addon->getIsTrial());
        self::assertEquals(true, $addon->getIsAddon());
        self::assertEquals(true, $addon->getHasAddons());
        self::assertEquals('microsoft', $addon->getVendorCode());
        self::assertEquals('Microsoft', $addon->getVendor());
        self::assertEquals('0F598EFE-F330-4D79-B79F-C9480BB7CE3E', $addon->getSku());
        self::assertEquals('MS-1A-M365-ENT', $addon->getServiceRef());
        self::assertEquals([], $addon->getCategory());
        self::assertEquals(true, $addon->getIsEnabled());
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
        self::assertEquals(true, $addon->getProgramIsEnabled());

        $priceBands = $addon->getPriceBands();
        self::assertCount(2, $priceBands);

        $priceBand = array_shift($priceBands);
        self::assertInstanceOf(PriceBand::class, $priceBand);
        self::assertEquals(1, $priceBand->getMinQuantity());
        self::assertEquals(10000000, $priceBand->getMaxQuantity());
        self::assertEquals(10, $priceBand->getRecurringBuyPrice());
        self::assertEquals(12, $priceBand->getRecurringSellPrice());
        self::assertEquals(null, $priceBand->getArrowPrice());
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
        self::assertEquals(null, $priceBand->getArrowPrice());
        self::assertEquals('1 Year', $priceBand->getTerm());
        self::assertEquals('LICENSE', $priceBand->getUnitType());
        self::assertEquals('per Year', $priceBand->getRecurringTimeUnit());
        self::assertEquals('USD', $priceBand->getCurrency());
        self::assertEquals(8640, $priceBand->getPeriodAsHours());
        self::assertEquals(8640, $priceBand->getTermAsHours());
    }
}
