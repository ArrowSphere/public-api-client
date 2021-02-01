<?php

namespace ArrowSphere\PublicApiClient\Tests\Catalog;

use ArrowSphere\PublicApiClient\Catalog\Entities\Offer;
use ArrowSphere\PublicApiClient\Catalog\Entities\OfferFindResult;
use ArrowSphere\PublicApiClient\Catalog\Entities\PriceBand;
use ArrowSphere\PublicApiClient\Catalog\OfferClient;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;
use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use ArrowSphere\PublicApiClient\Tests\AbstractClientTest;
use GuzzleHttp\Psr7\Response;

/**
 * Class OfferClientTest
 *
 * @property OfferClient $client
 */
class OfferClientTest extends AbstractClientTest
{
    protected const MOCKED_CLIENT_CLASS = OfferClient::class;

    public function testFindRaw(): void
    {
        $this->client->setPage(2);
        $this->client->setPerPage(15);

        $postData = [
            OfferClient::DATA_KEYWORDS   => 'office 365',
            OfferClient::DATA_FILTERS    => [
                Offer::COLUMN_VENDOR => 'Microsoft',
            ],
            OfferClient::DATA_SORT       => [
                Offer::COLUMN_NAME => OfferClient::SORT_DESCENDING,
            ],
            OfferClient::DATA_HIGHLIGHT  => true,
            OfferClient::DATA_TOP_OFFERS => true,
        ];

        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with(
                'post',
                'https://www.test.com/catalog/find?abc=def&ghi=0&page=2&per_page=15',
                [
                    'headers' => [
                        'apiKey' => '123456',
                    ],
                    'body'    => json_encode($postData),
                ]
            )
            ->willReturn(new Response(200, [], 'OK USA'));

        $this->client->findRaw($postData, [
            'abc' => 'def',
            'ghi' => false,
        ]);
    }

    /**
     * @depends testFindRaw
     */
    public function testAssociativeArray(): void
    {
        $postData = [
            OfferClient::DATA_KEYWORDS   => 'office 365',
            OfferClient::DATA_FILTERS    => [
                Offer::COLUMN_VENDOR => 'Microsoft',
                Offer::COLUMN_SKU => [
                    'first'  => 'ABC',
                    'second' => 'DEF',
                ],
            ],
            OfferClient::DATA_SORT       => [
                Offer::COLUMN_NAME => OfferClient::SORT_DESCENDING,
            ],
            OfferClient::DATA_HIGHLIGHT  => true,
            OfferClient::DATA_TOP_OFFERS => true,
        ];

        $expected = <<<JSON
{
    "keywords": "office 365",
    "filters": {
        "vendor": "Microsoft",
        "sku": [
            "ABC",
            "DEF"
        ]
    },
    "sort": {
        "name": "desc"
    },
    "highlight": true,
    "topOffers": true
}
JSON;

        // This line is to have minified JSON because it's what will be generated in the payload
        $expected = json_encode(json_decode($expected, true));

        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with(
                'post',
                'https://www.test.com/catalog/find',
                [
                    'headers' => [
                        'apiKey' => '123456',
                    ],
                    'body'    => $expected,
                ]
            )
            ->willReturn(new Response(200, [], 'OK USA'));

        $this->client->findRaw($postData);
    }

    /**
     * @depends testFindRaw
     * @throws PublicApiClientException
     * @throws EntityValidationException
     */
    public function testFindWithInvalidResponse(): void
    {
        $postData = [
            OfferClient::DATA_KEYWORDS   => 'office 365',
            OfferClient::DATA_FILTERS    => [
                Offer::COLUMN_VENDOR => 'Microsoft',
            ],
            OfferClient::DATA_SORT       => [
                Offer::COLUMN_NAME => OfferClient::SORT_DESCENDING,
            ],
            OfferClient::DATA_HIGHLIGHT  => true,
            OfferClient::DATA_TOP_OFFERS => true,
        ];

        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with(
                'post',
                'https://www.test.com/catalog/find?abc=def&ghi=0&page=2&per_page=15',
                [
                    'headers' => [
                        'apiKey' => '123456',
                    ],
                    'body'    => json_encode($postData),
                ]
            )
            ->willReturn(new Response(200, [], '{'));

        $this->expectException(PublicApiClientException::class);
        $this->client->find($postData, 15, 2, [
            'abc' => 'def',
            'ghi' => false,
        ]);
    }

    /**
     * @depends testFindRaw
     * @throws EntityValidationException
     * @throws PublicApiClientException
     */
    public function testFind(): void
    {
        $postData = [
            OfferClient::DATA_KEYWORDS   => 'office 365',
            OfferClient::DATA_FILTERS    => [
                Offer::COLUMN_VENDOR => 'Microsoft',
            ],
            OfferClient::DATA_SORT       => [
                Offer::COLUMN_NAME => OfferClient::SORT_DESCENDING,
            ],
            OfferClient::DATA_HIGHLIGHT  => true,
            OfferClient::DATA_TOP_OFFERS => true,
        ];

        $response = <<<JSON
{
    "products": [
        {
            "id": "45178cd297cf6e36488a13d211243227",
            "marketplace": "US",
            "sku": "031C9E47-4802-4248-838E-778FB1D2CC05",
            "name": "Microsoft 365 Business Standard",
            "type": "SAAS",
            "vendor": "Microsoft",
            "vendor_code": "microsoft",
            "category": [
                "Productivity"
            ],
            "customer_category": "Corporate",
            "service_ref": "MS-0A-O365-BUSINESS",
            "service_name": "Office 365 Business – (Corporate)",
            "keywords": [
                "Corporate"
            ],
            "is_addon": false,
            "has_addons": true,
            "is_trial": false,
            "thumbnail": "https://websource.myportal.cloud/images/Office365.jpg",
            "prices": [
                {
                    "min_quantity": 1,
                    "max_quantity": 300,
                    "recurring_buy_price": 6,
                    "recurring_sell_price": 8,
                    "term": "1 Year",
                    "unit_type": "LICENSE",
                    "recurring_time_unit": "per Month",
                    "currency": "USD",
                    "period_as_hours": 720,
                    "term_as_hours": 8640
                },
                {
                    "min_quantity": 1,
                    "max_quantity": 300,
                    "recurring_buy_price": 70,
                    "recurring_sell_price": 90,
                    "term": "1 Year",
                    "unit_type": "LICENSE",
                    "recurring_time_unit": "per Year",
                    "currency": "USD",
                    "period_as_hours": 8640,
                    "term_as_hours": 8640
                }
            ],
            "weight_top_sales": 11.173757047667863,
            "weight_forced": 0,
            "isEnabled": true,
            "program": {
                "isEnabled": true
            },
            "highlight": {
                "sku": [
                    "<strong>031C9E47</strong>-<strong>4802</strong>-<strong>4248</strong>-<strong>838E</strong>-<strong>778FB1D2CC05</strong>"
                ]
            }
        }
    ],
    "filters": [
        {
            "name": "is_addon",
            "values": [
                {
                    "value": "false",
                    "count": 1
                }
            ]
        },
        {
            "name": "vendor",
            "values": [
                {
                    "value": "Microsoft",
                    "count": 1
                }
            ]
        },
        {
            "name": "patator",
            "values": [
                {
                    "value": "toto",
                    "count": 3
                },
                {
                    "value": "tutu",
                    "count": 6
                }
            ]
        }
    ],
    "pagination": {
        "per_page": 15,
        "current_page": 1,
        "total_page": 1,
        "total": 1,
        "next": null,
        "previous": null
    }
}
JSON;

        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with(
                'post',
                'https://www.test.com/catalog/find?abc=def&ghi=0&per_page=15',
                [
                    'headers' => [
                        'apiKey' => '123456',
                    ],
                    'body'    => json_encode($postData),
                ]
            )
            ->willReturn(new Response(200, [], $response));

        $findResult = $this->client->find($postData, 15, 1, [
            'abc' => 'def',
            'ghi' => false,
        ]);

        self::assertEquals(1, $findResult->getNbResults());

        $filters = $findResult->getFilters();
        self::assertCount(3, $filters);

        $filter = array_shift($filters);
        self::assertEquals('is_addon', $filter->getName());
        self::assertEquals(
            [
                [
                    'value' => 'false',
                    'count' => 1,
                ],
            ],
            $filter->getValues()
        );

        $filter = array_shift($filters);
        self::assertEquals('vendor', $filter->getName());
        self::assertEquals(
            [
                [
                    'value' => 'Microsoft',
                    'count' => 1,
                ],
            ],
            $filter->getValues()
        );

        $filter = array_shift($filters);
        self::assertEquals('patator', $filter->getName());
        self::assertEquals(
            [
                [
                    'value' => 'toto',
                    'count' => 3,
                ],
                [
                    'value' => 'tutu',
                    'count' => 6,
                ],
            ],
            $filter->getValues()
        );

        /** @var OfferFindResult[] $offers */
        $offers = iterator_to_array($findResult->getOffers());

        self::assertCount(1, $offers);

        $offer = array_shift($offers);
        self::assertInstanceOf(OfferFindResult::class, $offer);
        self::assertEquals('Microsoft 365 Business Standard', $offer->getName());
        self::assertEquals(true, $offer->getHasAddons());
        self::assertEquals('US', $offer->getMarketplace());
        self::assertEquals('Office 365 Business – (Corporate)', $offer->getServiceName());
        self::assertEquals('Corporate', $offer->getCustomerCategory());
        self::assertEquals(11.173757047667863, $offer->getWeightTopSales());
        self::assertEquals(0, $offer->getWeightForced());
        self::assertEquals(['Productivity'], $offer->getCategory());
        self::assertEquals('MS-0A-O365-BUSINESS', $offer->getServiceRef());
        self::assertEquals('031C9E47-4802-4248-838E-778FB1D2CC05', $offer->getSku());
        self::assertEquals('Microsoft', $offer->getVendor());
        self::assertEquals('microsoft', $offer->getVendorCode());
        self::assertEquals(false, $offer->getIsAddon());
        self::assertEquals(false, $offer->getIsTrial());
        self::assertEquals('45178cd297cf6e36488a13d211243227', $offer->getId());
        self::assertEquals('SAAS', $offer->getClassification());
        self::assertEquals(true, $offer->getProgramIsEnabled());
        self::assertEquals(['Corporate'], $offer->getKeywords());
        self::assertEquals(
            [
                'sku' => [
                    '<strong>031C9E47</strong>-<strong>4802</strong>-<strong>4248</strong>-<strong>838E</strong>-<strong>778FB1D2CC05</strong>',
                ],
            ],
            $offer->getHighlight()
        );

        $priceBands = $offer->getPriceBands();
        self::assertCount(2, $priceBands);

        $priceBand = array_shift($priceBands);
        self::assertInstanceOf(PriceBand::class, $priceBand);
        self::assertEquals(1, $priceBand->getMinQuantity());
        self::assertEquals(300, $priceBand->getMaxQuantity());
        self::assertEquals(6, $priceBand->getRecurringBuyPrice());
        self::assertEquals(8, $priceBand->getRecurringSellPrice());
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
        self::assertEquals(300, $priceBand->getMaxQuantity());
        self::assertEquals(70, $priceBand->getRecurringBuyPrice());
        self::assertEquals(90, $priceBand->getRecurringSellPrice());
        self::assertEquals(null, $priceBand->getArrowPrice());
        self::assertEquals('1 Year', $priceBand->getTerm());
        self::assertEquals('LICENSE', $priceBand->getUnitType());
        self::assertEquals('per Year', $priceBand->getRecurringTimeUnit());
        self::assertEquals('USD', $priceBand->getCurrency());
        self::assertEquals(8640, $priceBand->getPeriodAsHours());
        self::assertEquals(8640, $priceBand->getTermAsHours());
    }

    /**
     * @throws PublicApiClientException
     */
    public function testGetDetailsRaw(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/catalog/details/myType/myVendor/mySku')
            ->willReturn(new Response(200, [], 'OK USA'));

        $this->client->getOfferDetailsRaw('myType', 'myVendor', 'mySku');
    }

    /**
     * @throws PublicApiClientException
     */
    public function testGetDetailsRawDisabled(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/catalog/details/myType/myVendor/mySku?enabled=0&test=1')
            ->willReturn(new Response(200, [], 'OK USA'));

        $this->client->getOfferDetailsRaw('myType', 'myVendor', 'mySku', [
            'enabled' => false,
            'test'    => true,
        ]);
    }

    /**
     * @depends testGetDetailsRaw
     * @throws PublicApiClientException
     */
    public function testGetDetails(): void
    {
        $response = <<<JSON
{
    "id": "45178cd297cf6e36488a13d211243227",
    "marketplace": "US",
    "sku": "031C9E47-4802-4248-838E-778FB1D2CC05",
    "name": "Microsoft 365 Business Standard",
    "type": "SAAS",
    "vendor": "Microsoft",
    "vendor_code": "microsoft",
    "category": [
        "Productivity"
    ],
    "customer_category": "Corporate",
    "service_ref": "MS-0A-O365-BUSINESS",
    "service_name": "Office 365 Business – (Corporate)",
    "keywords": [
        "Corporate"
    ],
    "is_addon": false,
    "has_addons": true,
    "is_trial": false,
    "thumbnail": "https://websource.myportal.cloud/images/Office365.jpg",
    "prices": [
        {
            "min_quantity": 1,
            "max_quantity": 300,
            "recurring_buy_price": 6,
            "recurring_sell_price": 8,
            "term": "1 Year",
            "unit_type": "LICENSE",
            "recurring_time_unit": "per Month",
            "currency": "USD",
            "period_as_hours": 720,
            "term_as_hours": 8640
        },
        {
            "min_quantity": 1,
            "max_quantity": 300,
            "recurring_buy_price": 70,
            "recurring_sell_price": 90,
            "term": "1 Year",
            "unit_type": "LICENSE",
            "recurring_time_unit": "per Year",
            "currency": "USD",
            "period_as_hours": 8640,
            "term_as_hours": 8640
        }
    ],
    "weight_top_sales": 11.173757047667863,
    "weight_forced": 0,
    "isEnabled": true,
    "program": {
        "isEnabled": true
    },
    "buying_program": "Corporate",
    "end_customer_features": "end customer features",
    "description": "description",
    "service_description": "service description",
    "prerequisites": [],
    "add_ons": [
        "0AA62437-B86A-48BD-AE51-85C8DCEC5E6D",
        "22355EB0-B6B6-484D-B856-29BE1F011300",
        "24CB1B30-B9C3-439A-B9CA-04ECC1338047",
        "27162687-FEEA-4D5A-8888-36A6C15ADD34",
        "2828BE95-46BA-4F91-B2FD-0BEF192ECF60",
        "2FC79CBC-5DB1-4E1F-AC16-95E420CB86A0",
        "35E68DB2-A6E2-4441-A7BF-FF52DDD50F53",
        "39D77D0F-EB8F-4EBC-B618-692E1CC59C8F",
        "3EA7E320-65E2-45F0-ABF5-6F6FABB2255B",
        "45320EC9-9B8E-49D0-B900-F14141A0ABD1",
        "4833683A-1E4A-4816-80CF-25238184B8C4",
        "4EF473F8-B01A-48DE-907F-7B20DD495E84",
        "53FC25F7-6639-4F78-BB44-3C2DFEC3ED40",
        "58DE892E-9962-4477-96F9-BC1BEF83A02C",
        "5A5BD617-7B27-41C7-96F0-37D125F7C47B",
        "64C8233D-29D5-47C1-91B2-773226487213",
        "7D45ECCD-B3B5-46CD-981F-4B0AB4597255",
        "7E614C9D-1738-4BF8-A963-B724CD4B1BAA",
        "84690799-E043-4DE3-B4BD-3E6493283C92",
        "984D3230-B916-4AED-ACC1-5522085D24B1",
        "9B7E5904-C73F-4D26-BC83-AD5B7F21409B",
        "9F9F2C7B-C961-402B-9421-8E3C9207EEB3",
        "A2706F86-868D-4048-989B-0C69E5C76B63",
        "A2DBDB89-FCEE-48DA-B9AC-ACB7DD4825FD",
        "AEB9DCA5-671D-42B2-91F9-B6F5915675A1",
        "B18A8E42-DA6D-464A-83CC-5BCBA7E8BD11",
        "B4155B38-A577-446C-BD1F-FF567F4C6780",
        "C94271D8-B431-4A25-A3C5-A57737A1C909",
        "CB038730-6CBE-47B9-AFD4-CA7FA5D0C39B",
        "CC69A07C-8C51-457F-BB2A-F21A62D6BEDE",
        "DAD393D5-5F4C-443C-95CE-240B687BD255",
        "EFB0C254-E9C6-4E9B-BE12-EB2B7849953F",
        "EFE1183A-8FA0-4138-BF0A-5AE271AB6E3C"
    ],
    "conversion_skus": [],
    "eula": "eula",
    "orderable_sku": "U0FBU3x8bWljcm9zb2Z0fHxNUy0wQS1PMzY1LUJVU0lORVNTfHwwMzFDOUU0Ny00ODAyLTQyNDgtODM4RS03NzhGQjFEMkNDMDU=",
    "full_features": "full features",
    "short_features": "short features",
    "features_picture": "https://websource.myportal.cloud/images/ars_feature/featureOffice365.png",
    "requirements": "requirements"
}
JSON;
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/catalog/details/SAAS/microsoft/031C9E47-4802-4248-838E-778FB1D2CC05')
            ->willReturn(new Response(200, [], $response));

        $offer = $this->client->getOfferDetails('SAAS', 'microsoft', '031C9E47-4802-4248-838E-778FB1D2CC05');
        self::assertEquals('Microsoft 365 Business Standard', $offer->getName());
        self::assertEquals(true, $offer->getHasAddons());
        self::assertEquals('US', $offer->getMarketplace());
        self::assertEquals('Office 365 Business – (Corporate)', $offer->getServiceName());
        self::assertEquals('Corporate', $offer->getCustomerCategory());
        self::assertEquals(11.173757047667863, $offer->getWeightTopSales());
        self::assertEquals(0, $offer->getWeightForced());
        self::assertEquals(['Productivity'], $offer->getCategory());
        self::assertEquals('MS-0A-O365-BUSINESS', $offer->getServiceRef());
        self::assertEquals('031C9E47-4802-4248-838E-778FB1D2CC05', $offer->getSku());
        self::assertEquals('Microsoft', $offer->getVendor());
        self::assertEquals('microsoft', $offer->getVendorCode());
        self::assertEquals(false, $offer->getIsAddon());
        self::assertEquals(false, $offer->getIsTrial());
        self::assertEquals('SAAS', $offer->getClassification());
        self::assertEquals(true, $offer->getProgramIsEnabled());
        self::assertEquals(['Corporate'], $offer->getKeywords());

        $priceBands = $offer->getPriceBands();
        self::assertCount(2, $priceBands);

        $priceBand = array_shift($priceBands);
        self::assertInstanceOf(PriceBand::class, $priceBand);
        self::assertEquals(1, $priceBand->getMinQuantity());
        self::assertEquals(300, $priceBand->getMaxQuantity());
        self::assertEquals(6, $priceBand->getRecurringBuyPrice());
        self::assertEquals(8, $priceBand->getRecurringSellPrice());
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
        self::assertEquals(300, $priceBand->getMaxQuantity());
        self::assertEquals(70, $priceBand->getRecurringBuyPrice());
        self::assertEquals(90, $priceBand->getRecurringSellPrice());
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
    public function testGetOffersRaw(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/catalog/categories/SAAS/programs/microsoft/products/MS-1A-M365-ENT/offers')
            ->willReturn(new Response(200, [], 'OK USA'));

        $this->client->getOffersRaw('SAAS', 'microsoft', 'MS-1A-M365-ENT');
    }

    /**
     * @depends testGetOffersRaw
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function testGetOffersWithInvalidResponse(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/catalog/categories/SAAS/programs/microsoft/products/MS-1A-M365-ENT/offers?per_page=100')
            ->willReturn(new Response(200, [], '{'));

        $this->expectException(PublicApiClientException::class);
        $offers = $this->client->getOffers('SAAS', 'microsoft', 'MS-1A-M365-ENT');
        iterator_to_array($offers);
    }

    /**
     * @depends testGetOffersRaw
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function testGetOffersWithPagination(): void
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
                ['get', 'https://www.test.com/catalog/categories/SAAS/programs/microsoft/products/MS-0B-O365-ENTERPRIS/offers?per_page=100'],
                ['get', 'https://www.test.com/catalog/categories/SAAS/programs/microsoft/products/MS-0B-O365-ENTERPRIS/offers?page=2&per_page=100'],
                ['get', 'https://www.test.com/catalog/categories/SAAS/programs/microsoft/products/MS-0B-O365-ENTERPRIS/offers?page=3&per_page=100']
            )
            ->willReturn(new Response(200, [], $response));

        $test = $this->client->getOffers('SAAS', 'microsoft', 'MS-0B-O365-ENTERPRIS');
        iterator_to_array($test);
    }

    /**
     * @depends testGetOffersRaw
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function testGetOffers(): void
    {
        $response = <<<JSON
{
  "status": 200,
  "data": [
    {
      "reference": "CAFF2897-D629-404A-A241-6B360E979609",
      "name": "Dynamics 365 Customer Voice Addl Responses",
      "associatedSubscriptionProgram": "MSCSP",
      "vendor": "Microsoft",
      "description": "description",
      "hasAddon": false,
      "isAddon": false,
      "isTrial": false,
      "product": "MS-0B-O365-ENTERPRIS",
      "program": "microsoft",
      "category": "SAAS",
      "orderableSku": "U0FBU3x8bWljcm9zb2Z0fHxNUy0wQi1PMzY1LUVOVEVSUFJJU3x8Q0FGRjI4OTctRDYyOS00MDRBLUEyNDEtNkIzNjBFOTc5NjA5",
      "prices": [
        {
          "min_quantity": 1,
          "max_quantity": 10000000,
          "recurring_buy_price": 50,
          "recurring_sell_price": 70,
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
          "recurring_buy_price": 600,
          "recurring_sell_price": 800,
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
        "product": "/api/catalog/categories/SAAS/programs/microsoft/products/MS-0B-O365-ENTERPRIS",
        "offer": "/api/catalog/categories/SAAS/programs/microsoft/products/MS-0B-O365-ENTERPRIS/offers/CAFF2897-D629-404A-A241-6B360E979609"
      },
      "eula": "eula"
    },
    {
      "reference": "796B6B5F-613C-4E24-A17C-EBA730D49C02",
      "name": "Office 365 E3",
      "associatedSubscriptionProgram": "MSCSP",
      "vendor": "Microsoft",
      "description": "description",
      "hasAddon": true,
      "isAddon": false,
      "isTrial": false,
      "product": "MS-0B-O365-ENTERPRIS",
      "program": "microsoft",
      "category": "SAAS",
      "orderableSku": "U0FBU3x8bWljcm9zb2Z0fHxNUy0wQi1PMzY1LUVOVEVSUFJJU3x8Nzk2QjZCNUYtNjEzQy00RTI0LUExN0MtRUJBNzMwRDQ5QzAy",
      "prices": [
        {
          "min_quantity": 1,
          "max_quantity": 10000000,
          "recurring_buy_price": 10,
          "recurring_sell_price": 14,
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
          "recurring_buy_price": 100,
          "recurring_sell_price": 140,
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
        "product": "/api/catalog/categories/SAAS/programs/microsoft/products/MS-0B-O365-ENTERPRIS",
        "offer": "/api/catalog/categories/SAAS/programs/microsoft/products/MS-0B-O365-ENTERPRIS/offers/796B6B5F-613C-4E24-A17C-EBA730D49C02",
        "addons": "/api/catalog/categories/SAAS/programs/microsoft/products/MS-0B-O365-ENTERPRIS/offers/796B6B5F-613C-4E24-A17C-EBA730D49C02/addons"
      },
      "eula": "eula"
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
            ->with('get', 'https://www.test.com/catalog/categories/SAAS/programs/microsoft/products/MS-0B-O365-ENTERPRIS/offers?per_page=100')
            ->willReturn(new Response(200, [], $response));

        $test = $this->client->getOffers('SAAS', 'microsoft', 'MS-0B-O365-ENTERPRIS');
        $list = iterator_to_array($test);
        self::assertCount(2, $list);

        /** @var Offer $offer */
        $offer = array_shift($list);
        self::assertInstanceOf(Offer::class, $offer);
        self::assertEquals('description', $offer->getDescription());
        self::assertEquals('SAAS', $offer->getClassification());
        self::assertEquals('Dynamics 365 Customer Voice Addl Responses', $offer->getName());
        self::assertEquals([], $offer->getKeywords());
        self::assertEquals('', $offer->getFullFeatures());
        self::assertEquals('', $offer->getShortFeatures());
        self::assertEquals('eula', $offer->getEula());
        self::assertEquals('', $offer->getFeaturesPicture());
        self::assertEquals('Corporate', $offer->getBuyingProgram());
        self::assertEquals(null, $offer->getPrerequisites());
        self::assertEquals('', $offer->getConversionSkus());
        self::assertEquals(false, $offer->getIsTrial());
        self::assertEquals(false, $offer->getIsAddon());
        self::assertEquals(false, $offer->getHasAddons());
        self::assertEquals('microsoft', $offer->getVendorCode());
        self::assertEquals('Microsoft', $offer->getVendor());
        self::assertEquals('CAFF2897-D629-404A-A241-6B360E979609', $offer->getSku());
        self::assertEquals('MS-0B-O365-ENTERPRIS', $offer->getServiceRef());
        self::assertEquals([], $offer->getCategory());
        self::assertEquals(true, $offer->getIsEnabled());
        self::assertEquals('', $offer->getRequirements());
        self::assertEquals(0, $offer->getWeightForced());
        self::assertEquals(0, $offer->getWeightTopSales());
        self::assertEquals('', $offer->getCustomerCategory());
        self::assertEquals('end user features', $offer->getEndCustomerFeatures());
        self::assertEquals('', $offer->getThumbnail());
        self::assertEquals('', $offer->getServiceDescription());
        self::assertEquals('', $offer->getServiceName());
        self::assertEquals('N/A', $offer->getMarketplace());
        self::assertEquals('U0FBU3x8bWljcm9zb2Z0fHxNUy0wQi1PMzY1LUVOVEVSUFJJU3x8Q0FGRjI4OTctRDYyOS00MDRBLUEyNDEtNkIzNjBFOTc5NjA5', $offer->getOrderableSku());
        self::assertEquals(true, $offer->getProgramIsEnabled());

        $priceBands = $offer->getPriceBands();
        self::assertCount(2, $priceBands);

        $priceBand = array_shift($priceBands);
        self::assertInstanceOf(PriceBand::class, $priceBand);
        self::assertEquals(1, $priceBand->getMinQuantity());
        self::assertEquals(10000000, $priceBand->getMaxQuantity());
        self::assertEquals(50, $priceBand->getRecurringBuyPrice());
        self::assertEquals(70, $priceBand->getRecurringSellPrice());
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
        self::assertEquals(600, $priceBand->getRecurringBuyPrice());
        self::assertEquals(800, $priceBand->getRecurringSellPrice());
        self::assertEquals(null, $priceBand->getArrowPrice());
        self::assertEquals('1 Year', $priceBand->getTerm());
        self::assertEquals('LICENSE', $priceBand->getUnitType());
        self::assertEquals('per Year', $priceBand->getRecurringTimeUnit());
        self::assertEquals('USD', $priceBand->getCurrency());
        self::assertEquals(8640, $priceBand->getPeriodAsHours());
        self::assertEquals(8640, $priceBand->getTermAsHours());

        /** @var Offer $offer */
        $offer = array_shift($list);
        self::assertInstanceOf(Offer::class, $offer);
        self::assertEquals('description', $offer->getDescription());
        self::assertEquals('SAAS', $offer->getClassification());
        self::assertEquals('Office 365 E3', $offer->getName());
        self::assertEquals([], $offer->getKeywords());
        self::assertEquals('', $offer->getFullFeatures());
        self::assertEquals('', $offer->getShortFeatures());
        self::assertEquals('eula', $offer->getEula());
        self::assertEquals('', $offer->getFeaturesPicture());
        self::assertEquals('Corporate', $offer->getBuyingProgram());
        self::assertEquals(null, $offer->getPrerequisites());
        self::assertEquals('', $offer->getConversionSkus());
        self::assertEquals(false, $offer->getIsTrial());
        self::assertEquals(false, $offer->getIsAddon());
        self::assertEquals(true, $offer->getHasAddons());
        self::assertEquals('microsoft', $offer->getVendorCode());
        self::assertEquals('Microsoft', $offer->getVendor());
        self::assertEquals('796B6B5F-613C-4E24-A17C-EBA730D49C02', $offer->getSku());
        self::assertEquals('MS-0B-O365-ENTERPRIS', $offer->getServiceRef());
        self::assertEquals([], $offer->getCategory());
        self::assertEquals(true, $offer->getIsEnabled());
        self::assertEquals('', $offer->getRequirements());
        self::assertEquals(0, $offer->getWeightForced());
        self::assertEquals(0, $offer->getWeightTopSales());
        self::assertEquals('', $offer->getCustomerCategory());
        self::assertEquals('end user features', $offer->getEndCustomerFeatures());
        self::assertEquals('', $offer->getThumbnail());
        self::assertEquals('', $offer->getServiceDescription());
        self::assertEquals('', $offer->getServiceName());
        self::assertEquals('N/A', $offer->getMarketplace());
        self::assertEquals('U0FBU3x8bWljcm9zb2Z0fHxNUy0wQi1PMzY1LUVOVEVSUFJJU3x8Nzk2QjZCNUYtNjEzQy00RTI0LUExN0MtRUJBNzMwRDQ5QzAy', $offer->getOrderableSku());
        self::assertEquals(true, $offer->getProgramIsEnabled());

        $priceBands = $offer->getPriceBands();
        self::assertCount(2, $priceBands);

        $priceBand = array_shift($priceBands);
        self::assertInstanceOf(PriceBand::class, $priceBand);
        self::assertEquals(1, $priceBand->getMinQuantity());
        self::assertEquals(10000000, $priceBand->getMaxQuantity());
        self::assertEquals(10, $priceBand->getRecurringBuyPrice());
        self::assertEquals(14, $priceBand->getRecurringSellPrice());
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
        self::assertEquals(100, $priceBand->getRecurringBuyPrice());
        self::assertEquals(140, $priceBand->getRecurringSellPrice());
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
    public function testGetOfferRaw(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/catalog/categories/SAAS/programs/microsoft/products/MS-0B-O365-ENTERPRIS/offers/CAFF2897-D629-404A-A241-6B360E979609')
            ->willReturn(new Response(200, [], 'OK USA'));

        $this->client->getOfferRaw('SAAS', 'microsoft', 'MS-0B-O365-ENTERPRIS', 'CAFF2897-D629-404A-A241-6B360E979609');
    }

    /**
     * @depends testGetOfferRaw
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function testGetOfferWithInvalidResponse(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/catalog/categories/SAAS/programs/microsoft/products/MS-0B-O365-ENTERPRIS/offers/CAFF2897-D629-404A-A241-6B360E979609')
            ->willReturn(new Response(200, [], '{'));

        $this->expectException(PublicApiClientException::class);
        $this->client->getOffer('SAAS', 'microsoft', 'MS-0B-O365-ENTERPRIS', 'CAFF2897-D629-404A-A241-6B360E979609');
    }

    /**
     * @depends testGetOfferRaw
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function testGetOffer(): void
    {
        $response = <<<JSON
{
  "status": 200,
  "data": {
    "reference": "CAFF2897-D629-404A-A241-6B360E979609",
    "name": "Dynamics 365 Customer Voice Addl Responses",
    "associatedSubscriptionProgram": "MSCSP",
    "vendor": "Microsoft",
    "description": "description",
    "hasAddon": false,
    "isAddon": false,
    "isTrial": false,
    "product": "MS-0B-O365-ENTERPRIS",
    "program": "microsoft",
    "category": "SAAS",
    "orderableSku": "U0FBU3x8bWljcm9zb2Z0fHxNUy0wQi1PMzY1LUVOVEVSUFJJU3x8Q0FGRjI4OTctRDYyOS00MDRBLUEyNDEtNkIzNjBFOTc5NjA5",
    "prices": [
      {
        "min_quantity": 1,
        "max_quantity": 10000000,
        "recurring_buy_price": 50,
        "recurring_sell_price": 70,
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
        "recurring_buy_price": 600,
        "recurring_sell_price": 800,
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
      "product": "/api/catalog/categories/SAAS/programs/microsoft/products/MS-0B-O365-ENTERPRIS",
      "offer": "/api/catalog/categories/SAAS/programs/microsoft/products/MS-0B-O365-ENTERPRIS/offers/CAFF2897-D629-404A-A241-6B360E979609"
    },
    "eula": "eula"
  }
}
JSON;
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/catalog/categories/SAAS/programs/microsoft/products/MS-0B-O365-ENTERPRIS/offers/CAFF2897-D629-404A-A241-6B360E979609')
            ->willReturn(new Response(200, [], $response));

        $offer = $this->client->getOffer('SAAS', 'microsoft', 'MS-0B-O365-ENTERPRIS', 'CAFF2897-D629-404A-A241-6B360E979609');
        self::assertEquals('description', $offer->getDescription());
        self::assertEquals('SAAS', $offer->getClassification());
        self::assertEquals('Dynamics 365 Customer Voice Addl Responses', $offer->getName());
        self::assertEquals([], $offer->getKeywords());
        self::assertEquals('', $offer->getFullFeatures());
        self::assertEquals('', $offer->getShortFeatures());
        self::assertEquals('eula', $offer->getEula());
        self::assertEquals('', $offer->getFeaturesPicture());
        self::assertEquals('Corporate', $offer->getBuyingProgram());
        self::assertEquals(null, $offer->getPrerequisites());
        self::assertEquals('', $offer->getConversionSkus());
        self::assertEquals(false, $offer->getIsTrial());
        self::assertEquals(false, $offer->getIsAddon());
        self::assertEquals(false, $offer->getHasAddons());
        self::assertEquals('microsoft', $offer->getVendorCode());
        self::assertEquals('Microsoft', $offer->getVendor());
        self::assertEquals('CAFF2897-D629-404A-A241-6B360E979609', $offer->getSku());
        self::assertEquals('MS-0B-O365-ENTERPRIS', $offer->getServiceRef());
        self::assertEquals([], $offer->getCategory());
        self::assertEquals(true, $offer->getIsEnabled());
        self::assertEquals('', $offer->getRequirements());
        self::assertEquals(0, $offer->getWeightForced());
        self::assertEquals(0, $offer->getWeightTopSales());
        self::assertEquals('', $offer->getCustomerCategory());
        self::assertEquals('end user features', $offer->getEndCustomerFeatures());
        self::assertEquals('', $offer->getThumbnail());
        self::assertEquals('', $offer->getServiceDescription());
        self::assertEquals('', $offer->getServiceName());
        self::assertEquals('N/A', $offer->getMarketplace());
        self::assertEquals('U0FBU3x8bWljcm9zb2Z0fHxNUy0wQi1PMzY1LUVOVEVSUFJJU3x8Q0FGRjI4OTctRDYyOS00MDRBLUEyNDEtNkIzNjBFOTc5NjA5', $offer->getOrderableSku());
        self::assertEquals(true, $offer->getProgramIsEnabled());

        $priceBands = $offer->getPriceBands();
        self::assertCount(2, $priceBands);

        $priceBand = array_shift($priceBands);
        self::assertInstanceOf(PriceBand::class, $priceBand);
        self::assertEquals(1, $priceBand->getMinQuantity());
        self::assertEquals(10000000, $priceBand->getMaxQuantity());
        self::assertEquals(50, $priceBand->getRecurringBuyPrice());
        self::assertEquals(70, $priceBand->getRecurringSellPrice());
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
        self::assertEquals(600, $priceBand->getRecurringBuyPrice());
        self::assertEquals(800, $priceBand->getRecurringSellPrice());
        self::assertEquals(null, $priceBand->getArrowPrice());
        self::assertEquals('1 Year', $priceBand->getTerm());
        self::assertEquals('LICENSE', $priceBand->getUnitType());
        self::assertEquals('per Year', $priceBand->getRecurringTimeUnit());
        self::assertEquals('USD', $priceBand->getCurrency());
        self::assertEquals(8640, $priceBand->getPeriodAsHours());
        self::assertEquals(8640, $priceBand->getTermAsHours());
    }
}
