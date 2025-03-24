<?php

namespace ArrowSphere\PublicApiClient\Tests\Licenses\Entities;

use ArrowSphere\PublicApiClient\Licenses\Entities\LicenseOfferFindResult;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

/**
 * Class LicenseOfferFindResultTest
 */
class LicenseOfferFindResultTest extends AbstractEntityTest
{
    protected const CLASS_NAME = LicenseOfferFindResult::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields' => [
                    'highlight' => [
                        'aaa',
                        'bbb',
                    ],
                    'license' => [
                        'id'                     => 123456,
                        'subscription_id'        => '12345678-AAAA-CCCC-FFFF-987654321012',
                        'parent_line_id'         => null,
                        'parent_order_ref'       => null,
                        'vendor_name'            => 'Microsoft',
                        'vendor_code'            => 'Microsoft',
                        'subsidiary_name'        => 'Arrow ECS Denmark',
                        'partner_ref'            => 'XSP987654321',
                        'status_code'            => 86,
                        'status_label'           => 'activation_ok',
                        'service_ref'            => 'MS-0B-O365-ENTERPRIS',
                        'sku'                    => 'ABCDABCD-1234-5678-9876-ABCDEFABCDEF',
                        'uom'                    => 'LICENSE',
                        'price'                  => [
                            'priceBandArrowsphereSku' => 'IBM_5737A82_DK_MS_EMM_PRE_PROD_1M_USD_1_999',
                            'buy_price'               => 10,
                            'sell_price'              => 15,
                            'list_price'              => 15,
                            'currency'                => 'USD',
                        ],
                        'cloud_type'             => 'SaaS',
                        'base_seat'              => 6,
                        'seat'                   => 6,
                        'trial'                  => false,
                        'auto_renew'             => true,
                        'offer'                  => 'Office 365 E3',
                        'category'               => 'BaseProduct',
                        'type'                   => 'recurring',
                        'start_date'             => '2020-11-18T17:48:43.000Z',
                        'end_date'               => '2021-11-18T17:48:43.000Z',
                        'next_renewal_date'      => '2021-11-18T17:48:43.000Z',
                        'accept_eula'            => false,
                        'customer_ref'           => 'XSP123456789',
                        'customer_name'          => 'My customer',
                        'reseller_ref'           => 'XSP12345',
                        'reseller_name'          => 'My reseller',
                        'marketplace'            => 'US',
                        'active_seats'           => [
                            'number'     => null,
                            'lastUpdate' => null,
                        ],
                        'friendly_name'          => 'XSP12345|MS-0B-O365-ENTERPRIS|XSP555555|XSP987654321',
                        'vendor_billing_id' => 'ABC123',
                        'vendor_subscription_id' => 'AABBCCDD-1111-2222-3333-ABCDEFABCDEF',
                        'customerVendorReference' => 'MyReference',
                        'message'                => '',
                        'periodicity'            => 720,
                        'term'                   => 8640,
                        'isEnabled'              => true,
                        'lastUpdate'             => '2020-12-08T15:42:30.069Z',
                    ],
                ],
                'expected' => <<<JSON
{
    "highlight": [
        "aaa",
        "bbb"
    ],
    "license": {
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
            "priceBandArrowsphereSku": "IBM_5737A82_DK_MS_EMM_PRE_PROD_1M_USD_1_999",
            "buy_price": 10,
            "sell_price": 15,
            "list_price": 15,
            "total_buy_price": 60,
            "total_sell_price": 90,
            "total_list_price": 90,
            "currency": "USD"
        },
        "cloud_type": "SaaS",
        "base_seat": 6,
        "configs": null,
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
        "customerVendorReference": "MyReference",
        "reseller_ref": "XSP12345",
        "reseller_name": "My reseller",
        "marketplace": "US",
        "active_seats": {
            "lastUpdate": null,
            "number": null
        },
        "friendly_name": "XSP12345|MS-0B-O365-ENTERPRIS|XSP555555|XSP987654321",
        "vendor_billing_id": "ABC123",
        "vendor_subscription_id": "AABBCCDD-1111-2222-3333-ABCDEFABCDEF",
        "message": "",
        "next_renewal_date": "2021-11-18T17:48:43.000Z",
        "periodicity": 720,
        "term": 8640,
        "isEnabled": true,
        "lastUpdate": "2020-12-08T15:42:30.069Z",
        "warnings": null,
        "security": {
            "activeFraudEvents": null
        }
    }
}
JSON
            ],
        ];
    }
}
