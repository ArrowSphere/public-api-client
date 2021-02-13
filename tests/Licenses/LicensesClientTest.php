<?php

namespace ArrowSphere\PublicApiClient\Tests\Licenses;

use ArrowSphere\PublicApiClient\Exception\EntityValidationException;
use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use ArrowSphere\PublicApiClient\Licenses\Entities\License;
use ArrowSphere\PublicApiClient\Licenses\Entities\LicenseFindResult;
use ArrowSphere\PublicApiClient\Licenses\LicensesClient;
use ArrowSphere\PublicApiClient\Tests\AbstractClientTest;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;

/**
 * Class OfferClientTest
 *
 * @property LicensesClient $client
 */
class LicensesClientTest extends AbstractClientTest
{
    protected const MOCKED_CLIENT_CLASS = LicensesClient::class;

    /**
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function testFindRaw(): void
    {
        $this->client->setPage(2);
        $this->client->setPerPage(15);

        $postData = [
            LicensesClient::DATA_KEYWORD   => 'office 365',
            LicensesClient::DATA_KEYWORDS  => [
                License::COLUMN_CUSTOMER_NAME => [
                    LicensesClient::KEYWORDS_VALUES   => [
                        'My customer',
                    ],
                    LicensesClient::KEYWORDS_OPERATOR => LicensesClient::OPERATOR_OR,
                ],
            ],
            LicensesClient::DATA_FILTERS   => [
                License::COLUMN_VENDOR_CODE => [
                    'Microsoft',
                    'IBM',
                ],
            ],
            LicensesClient::DATA_SORT      => [
                License::COLUMN_STATUS_CODE => LicensesClient::SORT_DESCENDING,
            ],
            LicensesClient::DATA_HIGHLIGHT => true,
        ];

        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with(
                'post',
                'https://www.test.com/licenses/find?abc=def&ghi=0&page=2&per_page=15',
                [
                    'headers' => [
                        'apiKey'       => '123456',
                        'Content-Type' => 'application/json',
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
     *
     * @throws PublicApiClientException
     * @throws NotFoundException
     * @throws GuzzleException
     */
    public function testAssociativeArray(): void
    {
        $postData = [
            LicensesClient::DATA_KEYWORD   => 'office 365',
            LicensesClient::DATA_KEYWORDS  => [
                License::COLUMN_CUSTOMER_NAME => [
                    LicensesClient::KEYWORDS_VALUES   => [
                        'first'  => 'My customer',
                        'second' => 'Other',
                    ],
                    LicensesClient::KEYWORDS_OPERATOR => LicensesClient::OPERATOR_OR,
                ],
            ],
            LicensesClient::DATA_FILTERS   => [
                License::COLUMN_VENDOR_CODE => [
                    'first'  => 'Microsoft',
                    'second' => 'IBM',
                ],
            ],
            LicensesClient::DATA_SORT      => [
                License::COLUMN_STATUS_CODE => LicensesClient::SORT_DESCENDING,
            ],
            LicensesClient::DATA_HIGHLIGHT => true,
        ];

        $expected = <<<JSON
{
    "keyword": "office 365",
    "keywords": {
        "customer_name": {
            "values": [
                "My customer",
                "Other"
            ],
            "operator": "OR"
        }
    },
    "filters": {
        "vendor_code": [
            "Microsoft",
            "IBM"
        ]
    },
    "sort": {
        "status_code": "desc"
    },
    "highlight": true
}
JSON;

        // This line is to have minified JSON because it's what will be generated in the payload
        $expected = json_encode(json_decode($expected, true));

        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with(
                'post',
                'https://www.test.com/licenses/find',
                [
                    'headers' => [
                        'apiKey'       => '123456',
                        'Content-Type' => 'application/json',
                    ],
                    'body'    => $expected,
                ]
            )
            ->willReturn(new Response(200, [], 'OK USA'));

        $this->client->findRaw($postData);
    }

    /**
     * @depends testFindRaw
     *
     * @throws PublicApiClientException
     * @throws EntityValidationException
     */
    public function testFindWithInvalidResponse(): void
    {
        $postData = [
            LicensesClient::DATA_KEYWORD   => 'office 365',
            LicensesClient::DATA_KEYWORDS  => [
                License::COLUMN_CUSTOMER_NAME => [
                    LicensesClient::KEYWORDS_VALUES   => [
                        'My customer',
                    ],
                    LicensesClient::KEYWORDS_OPERATOR => LicensesClient::OPERATOR_OR,
                ],
            ],
            LicensesClient::DATA_FILTERS   => [
                License::COLUMN_VENDOR_CODE => [
                    'Microsoft',
                    'IBM',
                ],
            ],
            LicensesClient::DATA_SORT      => [
                License::COLUMN_STATUS_CODE => LicensesClient::SORT_DESCENDING,
            ],
            LicensesClient::DATA_HIGHLIGHT => true,
        ];

        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with(
                'post',
                'https://www.test.com/licenses/find?abc=def&ghi=0&page=2&per_page=15',
                [
                    'headers' => [
                        'apiKey'       => '123456',
                        'Content-Type' => 'application/json',
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
     *
     * @throws EntityValidationException
     * @throws PublicApiClientException
     */
    public function testFind(): void
    {
        $postData = [
            LicensesClient::DATA_KEYWORD   => 'office 365',
            LicensesClient::DATA_KEYWORDS  => [
                License::COLUMN_CUSTOMER_NAME     => [
                    LicensesClient::KEYWORDS_VALUES   => [
                        'My customer',
                    ],
                    LicensesClient::KEYWORDS_OPERATOR => LicensesClient::OPERATOR_OR,
                ],
            ],
            LicensesClient::DATA_FILTERS   => [
                License::COLUMN_VENDOR_CODE => [
                    'Microsoft',
                    'IBM',
                ],
            ],
            LicensesClient::DATA_SORT      => [
                License::COLUMN_STATUS_CODE => LicensesClient::SORT_DESCENDING,
            ],
            LicensesClient::DATA_HIGHLIGHT => true,
        ];

        $response = <<<JSON
{
    "licenses": [
        {
            "id": 123456,
            "subscription_id": "12345678-AAAA-CCCC-FFFF-987654321012",
            "parent_line_id": null,
            "parent_order_ref": null,
            "vendor_name": "Microsoft",
            "vendor_code": "Microsoft",
            "subsidiary_name": "Arrow ECS Denmark",
            "partner_ref": "XSP987654321",
            "status_code": 86,
            "status_label": "activation_ok",
            "service_ref": "MS-0B-O365-ENTERPRIS",
            "sku": "ABCDABCD-1234-5678-9876-ABCDEFABCDEF",
            "uom": "LICENSE",
            "price": {
                "buy_price": 10,
                "list_price": 15,
                "currency": "USD"
            },
            "cloud_type": "SaaS",
            "base_seat": 6,
            "seat": 6,
            "trial": false,
            "auto_renew": true,
            "offer": "Office 365 E3",
            "category": "BaseProduct",
            "type": "recurring",
            "start_date": "2020-11-18T17:48:43.000Z",
            "end_date": "2021-11-18T17:48:43.000Z",
            "accept_eula": false,
            "customer_ref": "XSP123456789",
            "customer_name": "My customer",
            "reseller_ref": "XSP12345",
            "reseller_name": "My reseller",
            "marketplace": "US",
            "active_seats": {
                "number": null,
                "lastUpdate": null
            },
            "friendly_name": "XSP12345|MS-0B-O365-ENTERPRIS|XSP555555|XSP987654321",
            "vendor_subscription_id": "AABBCCDD-1111-2222-3333-ABCDEFABCDEF",
            "message": "",
            "periodicity": 720,
            "term": 8640,
            "isEnabled": true,
            "lastUpdate": "2020-12-08T15:42:30.069Z"
        },
        {
            "id": 123457,
            "subscription_id": "12345678-AAAA-CCCC-FFFF-987654321013",
            "parent_line_id": null,
            "parent_order_ref": null,
            "vendor_name": "Microsoft",
            "vendor_code": "Microsoft",
            "subsidiary_name": "Arrow ECS Denmark",
            "partner_ref": "XSP987654322",
            "status_code": 86,
            "status_label": "activation_ok",
            "service_ref": "MS-0B-O365-ENTERPRIS",
            "sku": "ABCDABCD-1234-5678-9876-ABCDEFABCCCC",
            "uom": "LICENSE",
            "price": {
                "buy_price": 12,
                "list_price": 17,
                "currency": "USD"
            },
            "cloud_type": "SaaS",
            "base_seat": 10,
            "seat": 8,
            "trial": false,
            "auto_renew": true,
            "offer": "Office 365 E5",
            "category": "BaseProduct",
            "type": "recurring",
            "start_date": "2020-11-18T17:48:43.000Z",
            "end_date": "2021-11-18T17:48:43.000Z",
            "accept_eula": false,
            "customer_ref": "XSP123456786",
            "customer_name": "My customer 2",
            "reseller_ref": "XSP12345",
            "reseller_name": "My reseller",
            "marketplace": "US",
            "active_seats": {
                "number": null,
                "lastUpdate": null
            },
            "friendly_name": "XSP12346|MS-0B-O365-ENTERPRIS|XSP555555|XSP987654322",
            "vendor_subscription_id": "AABBCCDD-1111-2222-3333-ABCDEFABCCCC",
            "message": "",
            "periodicity": 720,
            "term": 8640,
            "isEnabled": true,
            "lastUpdate": "2020-12-08T15:42:30.069Z"
        }
    ],
    "filters": [
        {
            "name": "vendor_code",
            "values": [
                {
                    "value": "Microsoft",
                    "count": 27664
                },
                {
                    "value": "IBM",
                    "count": 21
                }
            ]
        },
        {
            "name": "cloud_type",
            "values": [
                {
                    "value": "SAAS",
                    "count": 20850
                },
                {
                    "value": "IaaS",
                    "count": 1316
                }
            ]
        },
        {
            "name": "status_code",
            "values": [
                {
                    "value": 86,
                    "count": 11047
                },
                {
                    "value": 85,
                    "count": 335
                }
            ]
        },
        {
            "name": "isEnabled",
            "values": [
                {
                    "value": "false",
                    "count": 15972
                },
                {
                    "value": "true",
                    "count": 12739
                }
            ]
        },
        {
            "name": "periodicity",
            "values": [
                {
                    "value": 720,
                    "count": 27368
                },
                {
                    "value": 8640,
                    "count": 641
                }
            ]
        },
        {
            "name": "vendor_name",
            "values": [
                {
                    "value": "Microsoft",
                    "count": 27664
                },
                {
                    "value": "IBM Corp.",
                    "count": 21
                }
            ]
        },
        {
            "name": "term",
            "values": [
                {
                    "value": 8640,
                    "count": 25197
                },
                {
                    "value": 720,
                    "count": 284
                }
            ]
        }
    ],
    "pagination": {
        "perPage": 15,
        "currentPage": 1,
        "totalPage": 1,
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
                'https://www.test.com/licenses/find?abc=def&ghi=0&per_page=15',
                [
                    'headers' => [
                        'apiKey'       => '123456',
                        'Content-Type' => 'application/json',
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
        self::assertCount(7, $filters);

        $filter = array_shift($filters);
        self::assertEquals('vendor_code', $filter->getName());
        self::assertEquals(
            [
                [
                    'value' => 'Microsoft',
                    'count' => 27664,
                ],
                [
                    'value' => 'IBM',
                    'count' => 21,
                ],
            ],
            $filter->getValues()
        );

        $filter = array_shift($filters);
        self::assertEquals('cloud_type', $filter->getName());
        self::assertEquals(
            [
                [
                    'value' => 'SAAS',
                    'count' => 20850,
                ],
                [
                    'value' => 'IaaS',
                    'count' => 1316,
                ],
            ],
            $filter->getValues()
        );

        $filter = array_shift($filters);
        self::assertEquals('status_code', $filter->getName());
        self::assertEquals(
            [
                [
                    'value' => 86,
                    'count' => 11047,
                ],
                [
                    'value' => 85,
                    'count' => 335,
                ],
            ],
            $filter->getValues()
        );

        /** @var LicenseFindResult[] $licenses */
        $licenses = iterator_to_array($findResult->getLicenses());

        self::assertCount(2, $licenses);

        $license = array_shift($licenses);
        self::assertInstanceOf(LicenseFindResult::class, $license);
        self::assertEquals('US', $license->getMarketplace());
        self::assertEquals('BaseProduct', $license->getCategory());
        self::assertEquals('MS-0B-O365-ENTERPRIS', $license->getServiceRef());
        self::assertEquals('ABCDABCD-1234-5678-9876-ABCDEFABCDEF', $license->getSku());
        self::assertEquals('Microsoft', $license->getVendorCode());
        self::assertEquals(123456, $license->getId());
        self::assertEquals('SaaS', $license->getClassification());
        self::assertEquals([], $license->getHighlight());
    }

    /**
     * @depends testFind
     *
     * @throws EntityValidationException
     * @throws PublicApiClientException
     */
    public function testFindWithNullCurrency(): void
    {
        $postData = [
            LicensesClient::DATA_KEYWORD   => 'office 365',
            LicensesClient::DATA_KEYWORDS  => [
                License::COLUMN_CUSTOMER_NAME     => [
                    LicensesClient::KEYWORDS_VALUES   => [
                        'My customer',
                    ],
                    LicensesClient::KEYWORDS_OPERATOR => LicensesClient::OPERATOR_OR,
                ],
            ],
            LicensesClient::DATA_FILTERS   => [
                License::COLUMN_VENDOR_CODE => [
                    'Microsoft',
                    'IBM',
                ],
            ],
            LicensesClient::DATA_SORT      => [
                License::COLUMN_STATUS_CODE => LicensesClient::SORT_DESCENDING,
            ],
            LicensesClient::DATA_HIGHLIGHT => true,
        ];

        $response = <<<JSON
{
    "licenses": [
        {
            "id": 123456,
            "subscription_id": "12345678-AAAA-CCCC-FFFF-987654321012",
            "parent_line_id": null,
            "parent_order_ref": null,
            "vendor_name": "Amazon",
            "vendor_code": "aws",
            "subsidiary_name": "Arrow ECS Denmark",
            "partner_ref": "XSP987654321",
            "status_code": 86,
            "status_label": "activation_ok",
            "service_ref": "AWS_AMAZON_SUBSCRIPTION",
            "sku": "ABCDABCD-1234-5678-9876-ABCDEFABCDEF",
            "uom": "ACCOUNT",
            "price": {
                "buy_price": 0,
                "list_price": 0,
                "currency": null
            },
            "cloud_type": "IaaS",
            "base_seat": 6,
            "seat": 6,
            "trial": false,
            "auto_renew": true,
            "offer": "AWS Distribution Account Model (DAM)",
            "category": "BaseProduct",
            "type": "recurring",
            "start_date": "2020-11-18T17:48:43.000Z",
            "end_date": "2021-11-18T17:48:43.000Z",
            "accept_eula": false,
            "customer_ref": "XSP123456789",
            "customer_name": "My customer",
            "reseller_ref": "XSP12345",
            "reseller_name": "My reseller",
            "marketplace": "US",
            "active_seats": {
                "number": null,
                "lastUpdate": null
            },
            "friendly_name": null,
            "vendor_subscription_id": null,
            "message": "",
            "periodicity": 720,
            "term": 0,
            "isEnabled": true,
            "lastUpdate": "2020-12-08T15:42:30.069Z"
        }
    ],
    "filters": [],
    "pagination": {
        "perPage": 15,
        "currentPage": 1,
        "totalPage": 1,
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
                'https://www.test.com/licenses/find?abc=def&ghi=0&per_page=15',
                [
                    'headers' => [
                        'apiKey'       => '123456',
                        'Content-Type' => 'application/json',
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

        /** @var LicenseFindResult[] $licenses */
        $licenses = iterator_to_array($findResult->getLicenses());

        self::assertCount(1, $licenses);

        $license = array_shift($licenses);
        self::assertInstanceOf(LicenseFindResult::class, $license);
        self::assertEquals('US', $license->getMarketplace());
        self::assertEquals('BaseProduct', $license->getCategory());
        self::assertEquals('AWS_AMAZON_SUBSCRIPTION', $license->getServiceRef());
        self::assertEquals('ABCDABCD-1234-5678-9876-ABCDEFABCDEF', $license->getSku());
        self::assertEquals('aws', $license->getVendorCode());
        self::assertEquals(123456, $license->getId());
        self::assertEquals('IaaS', $license->getClassification());
        self::assertEquals([], $license->getHighlight());
        self::assertNull($license->getCurrency());
        self::assertNull($license->getFriendlyName());
        self::assertNull($license->getVendorSubscriptionId());
    }
}
