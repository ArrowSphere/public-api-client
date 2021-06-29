<?php

namespace ArrowSphere\PublicApiClient\Tests\Billing\Entities;

use ArrowSphere\PublicApiClient\Billing\Entities\StatementLine;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

/**
 * Class StatementLineTest
 */
class StatementLineTest extends AbstractEntityTest
{
    protected const CLASS_NAME = StatementLine::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields' => [
                    'reference' => 'H1-AAA-deadbeefdeadbeefdeadbeefdeadbeef',
                    'vendorEndCustomerSubscriptionId' => '12345678-1234-1234-1234-123456789012',
                    'vendorName' => 'Vendor',
                    'vendorProgram' => 'Program',
                    'vendorProgramClassification' => 'SAAS',
                    'vendorProductName' => 'Product Name',
                    'vendorSku' => '12345678-1234-1234-1234-123456789012',
                    'arrowSku' => '12345678-1234-1234-1234-123456789012',
                    'offerName' => 'Offer Name',
                    'subscriptionFriendlyName' => null,
                    'arsSubscriptionId' => 'XSP123',
                    'orderId' => 'Order Id',
                    'resellerOrderId' => 'Reseller Order Id',
                    'subscriptionStartDate' => '2021-03-17 00:00:00',
                    'subscriptionEndDate' => '2022-03-17 00:00:00',
                    'billingPeriodicity' => 'Monthly',
                    'billingPeriodStart' => '2021-04-01 00:00:00',
                    'billingPeriodEnd' => '2021-04-30 00:00:00',
                    'usageStartDate' => '2021-04-01 00:00:00',
                    'usageEndDate' => '2021-04-30 00:00:00',
                    'rates' => [
                        'sellRate' => 1.0874,
                        'sellRateType' => 'uplift',
                    ],
                    'quantity' => 4,
                    'currency' => 'EUR',
                    'prices' => [
                        'listUnit' => 4.1689,
                        'listTotal' => 16.6755,
                        'buyUnit' => 4.6951,
                        'buyTotal' => 18.7805,
                        'sellUnit' => 9.8006,
                        'sellTotal' => 39.2024,
                    ],
                ],
                'expected' => <<<JSON
{
    "reference": "H1-AAA-deadbeefdeadbeefdeadbeefdeadbeef",
    "vendorEndCustomerSubscriptionId": "12345678-1234-1234-1234-123456789012",
    "vendorName": "Vendor",
    "vendorProgram": "Program",
    "vendorProgramClassification": "SAAS",
    "vendorProductName": "Product Name",
    "vendorSku": "12345678-1234-1234-1234-123456789012",
    "arrowSku": "12345678-1234-1234-1234-123456789012",
    "offerName": "Offer Name",
    "subscriptionFriendlyName": null,
    "arsSubscriptionId": "XSP123",
    "orderId": "Order Id",
    "resellerOrderId": "Reseller Order Id",
    "subscriptionStartDate": "2021-03-17 00:00:00",
    "subscriptionEndDate": "2022-03-17 00:00:00",
    "billingPeriodicity": "Monthly",
    "billingPeriodStart": "2021-04-01 00:00:00",
    "billingPeriodEnd": "2021-04-30 00:00:00",
    "usageStartDate": "2021-04-01 00:00:00",
    "usageEndDate": "2021-04-30 00:00:00",
    "rates": {
        "sellRate": 1.0874,
        "sellRateType": "uplift"
    },
    "quantity": 4,
    "currency": "EUR",
    "prices": {
        "listUnit": 4.1689,
        "listTotal": 16.6755,
        "buyUnit": 4.6951,
        "buyTotal": 18.7805,
        "sellUnit": 9.8006,
        "sellTotal": 39.2024
    }
}
JSON
            ],
        ];
    }
}
