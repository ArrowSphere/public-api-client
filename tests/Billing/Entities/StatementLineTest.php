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
                    'resellerBillingTag' => 'TAG',
                    'vendorName' => 'Vendor',
                    'vendorProgram' => 'Program',
                    'vendorProgramClassification' => 'SAAS',
                    'vendorProductName' => 'Product Name',
                    'serviceCode' => 'SERVICE-CODE',
                    'vendorSku' => '12345678-1234-1234-1234-123456789012',
                    'arrowSku' => '12345678-1234-1234-1234-123456789012',
                    'orderId' => 'Order Id',
                    'resellerOrderId' => 'Reseller Order Id',
                    'billingPeriodStart' => '2021-04-01 00:00:00',
                    'billingPeriodEnd' => '2021-04-30 00:00:00',
                    'usageStartDate' => '2021-04-01 00:00:00',
                    'usageEndDate' => '2021-04-30 00:00:00',
                    'subscriptionStartDate' => '2021-03-17 00:00:00',
                    'subscriptionEndDate' => '2022-03-17 00:00:00',
                    'billingPeriodicity' => 'Monthly',
                    'quantity' => 4,
                    'subscriptionFriendlyName' => null,
                    'arsSubscriptionId' => 'XSP123',
                    'offerName' => 'Offer Name',
                    'exchangeRate' => 1,
                    'endCustomerRate' => 1.0874,
                    'endCustomerRateType' => 'uplift',
                    'vendorCurrency' => 'USD',
                    'vendorRetailUnitBuyPrice' => 6.87,
                    'vendorRetailTotalBuyPrice' => 27.48,
                    'vendorResellerUnitBuyPrice' => 6.183,
                    'vendorResellerTotalBuyPrice' => 24.732,
                    'vendorEndCustomerUnitBuyPrice' => 12.9064,
                    'vendorEndCustomerTotalBuyPrice' => 51.6256,
                    'countryCurrency' => 'EUR',
                    'countryRetailUnitBuyPrice' => 4.1689,
                    'countryRetailTotalBuyPrice' => 16.6755,
                    'countryResellerUnitBuyPrice' => 4.6951,
                    'countryResellerTotalBuyPrice' => 18.7805,
                    'countryEndCustomerUnitBuyPrice' => 9.8006,
                    'countryEndCustomerTotalBuyPrice' => 39.2024,
                    'description' => 'Description',
                ],
                'expected' => <<<JSON
{
    "reference": "H1-AAA-deadbeefdeadbeefdeadbeefdeadbeef",
    "vendorEndCustomerSubscriptionId": "12345678-1234-1234-1234-123456789012",
    "resellerBillingTag": "TAG",
    "vendorName": "Vendor",
    "vendorProgram": "Program",
    "vendorProgramClassification": "SAAS",
    "vendorProductName": "Product Name",
    "serviceCode": "SERVICE-CODE",
    "vendorSku": "12345678-1234-1234-1234-123456789012",
    "arrowSku": "12345678-1234-1234-1234-123456789012",
    "orderId": "Order Id",
    "resellerOrderId": "Reseller Order Id",
    "billingPeriodStart": "2021-04-01 00:00:00",
    "billingPeriodEnd": "2021-04-30 00:00:00",
    "usageStartDate": "2021-04-01 00:00:00",
    "usageEndDate": "2021-04-30 00:00:00",
    "subscriptionStartDate": "2021-03-17 00:00:00",
    "subscriptionEndDate": "2022-03-17 00:00:00",
    "billingPeriodicity": "Monthly",
    "quantity": 4,
    "subscriptionFriendlyName": null,
    "arsSubscriptionId": "XSP123",
    "offerName": "Offer Name",
    "exchangeRate": 1,
    "endCustomerRate": 1.0874,
    "endCustomerRateType": "uplift",
    "vendorCurrency": "USD",
    "vendorRetailUnitBuyPrice": 6.87,
    "vendorRetailTotalBuyPrice": 27.48,
    "vendorResellerUnitBuyPrice": 6.183,
    "vendorResellerTotalBuyPrice": 24.732,
    "vendorEndCustomerUnitBuyPrice": 12.9064,
    "vendorEndCustomerTotalBuyPrice": 51.6256,
    "countryCurrency": "EUR",
    "countryRetailUnitBuyPrice": 4.1689,
    "countryRetailTotalBuyPrice": 16.6755,
    "countryResellerUnitBuyPrice": 4.6951,
    "countryResellerTotalBuyPrice": 18.7805,
    "countryEndCustomerUnitBuyPrice": 9.8006,
    "countryEndCustomerTotalBuyPrice": 39.2024,
    "description": "Description"
}
JSON
            ],
        ];
    }
}
