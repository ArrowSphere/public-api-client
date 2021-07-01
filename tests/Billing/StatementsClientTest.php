<?php

namespace ArrowSphere\PublicApiClient\Tests\Billing;

use ArrowSphere\PublicApiClient\Billing\Entities\Identity;
use ArrowSphere\PublicApiClient\Billing\Entities\Statement;
use ArrowSphere\PublicApiClient\Billing\Entities\StatementLine;
use ArrowSphere\PublicApiClient\Billing\StatementsClient;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;
use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use ArrowSphere\PublicApiClient\Tests\AbstractClientTest;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;

/**
 * Class StatementsClientTest
 *
 * @property StatementsClient $client
 */
class StatementsClientTest extends AbstractClientTest
{
    protected const MOCKED_CLIENT_CLASS = StatementsClient::class;

    /**
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function testGetStatementRaw(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/billing/statements/42')
            ->willReturn(new Response(200, [], 'OK USA'));

        $response = $this->client->getStatementRaw('42');
        self::assertSame('OK USA', $response);
    }

    /**
     * @depends testGetStatementRaw
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function testGetStatement(): void
    {
        $response = json_encode([
            'code' => 0,
            'message' => 'success',
            'data' => [
                'billingStatement' => [
                    'reference' => 'H1-AAA-deadbeefdeadbeefdeadbeefdeadbeef',
                    'strategy' => 'mscsp-saas-monthly',
                    'group' => 'ArrowBilling',
                    'status' => 'Open',
                    'from' => [
                        'reference' => 'XSP1337',
                        'name' => 'Reseller',
                    ],
                    'to' => [
                        [
                            'reference' => 'XSP123',
                            'name' => 'Customer',
                        ]
                    ],
                    'creationDate' => '2021-05-21 13:37:00',
                    'submissionDate' => '2021-05-22 13:37:00',
                    'issueDate' => '2021-04-29 13:37:00',
                    'marketplace' => 'US',
                    'vendorCurrency' => 'EUR',
                    'vendorResellerTotalBuyPrice' => 43.0,
                    'vendorEndCustomerTotalBuyPrice' => 22.1,
                    'countryCurrency' => 'USD',
                    'countryResellerTotalBuyPrice' => 42.0,
                    'countryEndCustomerTotalBuyPrice' => 23.1,
                ],
            ],
        ]);

        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/billing/statements/42')
            ->willReturn(new Response(200, [], $response));

        $statement = $this->client->getStatement('42');
        self::assertInstanceOf(Statement::class, $statement);
        self::assertSame('H1-AAA-deadbeefdeadbeefdeadbeefdeadbeef', $statement->getReference());
        self::assertSame('mscsp-saas-monthly', $statement->getStrategy());
        self::assertSame('ArrowBilling', $statement->getGroup());
        self::assertSame('Open', $statement->getStatus());
        self::assertSame('2021-05-21 13:37:00', $statement->getCreationDate());
        self::assertSame('2021-05-22 13:37:00', $statement->getSubmissionDate());
        self::assertSame('2021-04-29 13:37:00', $statement->getIssueDate());
        self::assertSame('US', $statement->getMarketplace());
    }

    /**
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function testGetStatementsRaw(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/billing/statements?periodFrom=2021-04&periodTo=2021-05')
            ->willReturn(new Response(200, [], 'OK USA'));

        $this->client->getStatementsRaw('2021-04', '2021-05');
    }

    /**
     * @depends testGetStatementsRaw
     *
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function testGetStatementsWithInvalidResponse(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/billing/statements?periodFrom=2021-04&periodTo=2021-05&perPage=100')
            ->willReturn(new Response(200, [], '{'));

        $this->expectException(PublicApiClientException::class);
        $statements = $this->client->getStatements('2021-04', '2021-05');
        iterator_to_array($statements);
    }

    /**
     * @throws EntityValidationException
     * @throws GuzzleException
     * @throws PublicApiClientException
     */
    public function testGetStatementsWithPagination(): void
    {
        $response = json_encode([
            'data'       => [
                'billingStatements' => [],
            ],
            'pagination' => [
                'totalPages' => 3,
            ],
        ]);

        $this->httpClient
            ->expects(self::exactly(3))
            ->method('request')
            ->withConsecutive(
                ['get', 'https://www.test.com/billing/statements?periodFrom=2021-04&periodTo=2021-05&perPage=100'],
                ['get', 'https://www.test.com/billing/statements?periodFrom=2021-04&periodTo=2021-05&page=2&perPage=100'],
                ['get', 'https://www.test.com/billing/statements?periodFrom=2021-04&periodTo=2021-05&page=3&perPage=100']
            )
            ->willReturn(new Response(200, [], $response));

        $statements = $this->client->getStatements('2021-04', '2021-05');
        iterator_to_array($statements);
    }

    /**
     * @throws PublicApiClientException
     */
    public function testGetStatements(): void
    {
        $response = json_encode([
            'code' => 0,
            'message' => 'success',
            'endpointTitle' => '/billing/statements',
            'data' => [
                'billingStatements' => [
                    [
                        'reference' => 'H1-AAA-deadbeefdeadbeefdeadbeefdeadbeef',
                        'strategy' => 'mscsp-saas-monthly',
                        'group' => 'ArrowBilling',
                        'status' => 'Open',
                        'from' => [
                            'reference' => 'XSP1337',
                            'name' => 'Reseller',
                        ],
                        'to' => [
                            [
                                'reference' => 'XSP123',
                                'name' => 'Customer',
                            ]
                        ],
                        'creationDate' => '2021-05-21 13:37:00',
                        'submissionDate' => '2021-05-22 13:37:00',
                        'issueDate' => '2021-04-29 13:37:00',
                        'marketplace' => 'US',
                        'vendorCurrency' => 'EUR',
                        'vendorResellerTotalBuyPrice' => 43.0,
                        'vendorEndCustomerTotalBuyPrice' => 22.1,
                        'countryCurrency' => 'USD',
                        'countryResellerTotalBuyPrice' => 42.0,
                        'countryEndCustomerTotalBuyPrice' => 23.1,
                    ],
                    [
                        'reference' => 'H1-BBB-deadbeefdeadbeefdeadbeefdeadbeef',
                        'strategy' => 'mscsp-iaas-monthly',
                        'group' => 'ArrowBilling',
                        'status' => 'Needs Validation',
                        'from' => [
                            'reference' => 'XSP1337',
                            'name' => 'Reseller',
                        ],
                        'to' => [
                            [
                                'reference' => 'XSP123',
                                'name' => 'Customer',
                            ]
                        ],
                        'creationDate' => '2021-05-21 13:37:00',
                        'submissionDate' => '2021-05-22 13:37:00',
                        'issueDate' => '2021-04-29 13:37:00',
                        'marketplace' => 'US',
                        'vendorCurrency' => 'EUR',
                        'vendorResellerTotalBuyPrice' => 43.0,
                        'vendorEndCustomerTotalBuyPrice' => 22.1,
                        'countryCurrency' => 'USD',
                        'countryResellerTotalBuyPrice' => 42.0,
                        'countryEndCustomerTotalBuyPrice' => 23.1,
                    ],
                    [
                        'reference' => 'H1-CCC-deadbeefdeadbeefdeadbeefdeadbeef',
                        'strategy' => 'mscsp-saas-monthly',
                        'group' => 'ArrowBilling',
                        'status' => 'Fulfilled',
                        'from' => [
                            'reference' => 'XSP1337',
                            'name' => 'Reseller',
                        ],
                        'to' => [
                            [
                                'reference' => 'XSP123',
                                'name' => 'Customer',
                            ]
                        ],
                        'creationDate' => '2021-05-21 13:37:00',
                        'submissionDate' => '2021-05-22 13:37:00',
                        'issueDate' => '2021-04-29 13:37:00',
                        'marketplace' => 'US',
                        'vendorCurrency' => 'EUR',
                        'vendorResellerTotalBuyPrice' => 43.0,
                        'vendorEndCustomerTotalBuyPrice' => 22.1,
                        'countryCurrency' => 'USD',
                        'countryResellerTotalBuyPrice' => 42.0,
                        'countryEndCustomerTotalBuyPrice' => 23.1,
                    ],
                ],
            ],
            'pagination' => [
                'total' => 3,
                'perPage' => 100,
                'currentPage' => 1,
                'totalPages' => 1,
                'prevUrl' => null,
                'nextUrl' => null,
            ],
        ]);

        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/billing/statements?periodFrom=2021-04&periodTo=2021-05&perPage=100')
            ->willReturn(new Response(200, [], $response));

        $statements = $this->client->getStatements('2021-04', '2021-05');
        $list = iterator_to_array($statements);
        self::assertCount(3, $list);

        /** @var Statement $statement */
        $statement = array_shift($list);
        self::assertInstanceOf(Statement::class, $statement);
        self::assertSame('H1-AAA-deadbeefdeadbeefdeadbeefdeadbeef', $statement->getReference());
        self::assertSame('mscsp-saas-monthly', $statement->getStrategy());
        self::assertSame('ArrowBilling', $statement->getGroup());
        self::assertSame('Open', $statement->getStatus());
        self::assertSame('2021-05-21 13:37:00', $statement->getCreationDate());
        self::assertSame('2021-05-22 13:37:00', $statement->getSubmissionDate());
        self::assertSame('2021-04-29 13:37:00', $statement->getIssueDate());
        self::assertSame('US', $statement->getMarketplace());
        self::assertSame('EUR', $statement->getVendorCurrency());
        self::assertSame(43.0, $statement->getVendorResellerTotalBuyPrice());
        self::assertSame(22.1, $statement->getVendorEndCustomerTotalBuyPrice());
        self::assertSame('USD', $statement->getCountryCurrency());
        self::assertSame(42.0, $statement->getCountryResellerTotalBuyPrice());
        self::assertSame(23.1, $statement->getCountryEndCustomerTotalBuyPrice());

        $from = $statement->getFrom();
        self::assertInstanceOf(Identity::class, $from);
        self::assertSame('XSP1337', $from->getReference());
        self::assertSame('Reseller', $from->getName());

        /** @var Identity $to */
        $list = $statement->getTo();
        $to = array_shift($list);
        self::assertInstanceOf(Identity::class, $to);
        self::assertSame('XSP123', $to->getReference());
        self::assertSame('Customer', $to->getName());
    }

    /**
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function testGetStatementLinesRaw(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/billing/statements/H1-AAA-deadbeefdeadbeefdeadbeefdeadbeef/lines')
            ->willReturn(new Response(200, [], 'OK USA'));

        $response = $this->client->getStatementLinesRaw('H1-AAA-deadbeefdeadbeefdeadbeefdeadbeef');
        self::assertSame('OK USA', $response);
    }

    /**
     * @depends testGetStatementLinesRaw
     *
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function testGetStatementLinesWithInvalidResponse(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/billing/statements/H1-AAA-deadbeefdeadbeefdeadbeefdeadbeef/lines?perPage=100')
            ->willReturn(new Response(200, [], '{'));

        $this->expectException(PublicApiClientException::class);
        $statements = $this->client->getStatementLines('H1-AAA-deadbeefdeadbeefdeadbeefdeadbeef');
        iterator_to_array($statements);
    }

    /**
     * @throws EntityValidationException
     * @throws GuzzleException
     * @throws PublicApiClientException
     */
    public function testGetStatementLinesWithPagination(): void
    {
        $response = json_encode([
            'data'       => [
                'billingStatementLines' => [],
            ],
            'pagination' => [
                'totalPages' => 3,
            ],
        ]);

        $this->httpClient
            ->expects(self::exactly(3))
            ->method('request')
            ->withConsecutive(
                ['get', 'https://www.test.com/billing/statements/H1-AAA-deadbeefdeadbeefdeadbeefdeadbeef/lines?perPage=100'],
                ['get', 'https://www.test.com/billing/statements/H1-AAA-deadbeefdeadbeefdeadbeefdeadbeef/lines?page=2&perPage=100'],
                ['get', 'https://www.test.com/billing/statements/H1-AAA-deadbeefdeadbeefdeadbeefdeadbeef/lines?page=3&perPage=100']
            )
            ->willReturn(new Response(200, [], $response));

        $statements = $this->client->getStatementLines('H1-AAA-deadbeefdeadbeefdeadbeefdeadbeef');
        iterator_to_array($statements);
    }

    /**
     * @throws PublicApiClientException
     */
    public function testGetStatementLines(): void
    {
        $response = json_encode([
            'code' => 0,
            'message' => 'success',
            'data' => [
                'billingStatementLines' => [
                    [
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
                    [
                        'reference' => 'H1-BBB-deadbeefdeadbeefdeadbeefdeadbeef',
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
                    [
                        'reference' => 'H1-CCC-deadbeefdeadbeefdeadbeefdeadbeef',
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
                ],
            ],
            'pagination' => [
                'total' => 3,
                'perPage' => 100,
                'currentPage' => 1,
                'totalPages' => 1,
                'prevUrl' => null,
                'nextUrl' => null,
            ],
        ]);

        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/billing/statements/H1-AAA-deadbeefdeadbeefdeadbeefdeadbeef/lines?perPage=100')
            ->willReturn(new Response(200, [], $response));

        $lines = $this->client->getStatementLines('H1-AAA-deadbeefdeadbeefdeadbeefdeadbeef');
        $list = iterator_to_array($lines);
        self::assertCount(3, $list);

        /** @var StatementLine $line */
        $line = array_shift($list);
        self::assertInstanceOf(StatementLine::class, $line);
        self::assertSame('H1-AAA-deadbeefdeadbeefdeadbeefdeadbeef', $line->getReference());
        self::assertSame('12345678-1234-1234-1234-123456789012', $line->getVendorEndCustomerSubscriptionId());
        self::assertSame('TAG', $line->getResellerBillingTag());
        self::assertSame('Vendor', $line->getVendorName());
        self::assertSame('Program', $line->getVendorProgram());
        self::assertSame('SAAS', $line->getVendorProgramClassification());
        self::assertSame('Product Name', $line->getVendorProductName());
        self::assertSame('SERVICE-CODE', $line->getServiceCode());
        self::assertSame('12345678-1234-1234-1234-123456789012', $line->getVendorSku());
        self::assertSame('12345678-1234-1234-1234-123456789012', $line->getArrowSku());
        self::assertSame('Order Id', $line->getOrderId());
        self::assertSame('Reseller Order Id', $line->getResellerOrderId());
        self::assertSame('2021-04-01 00:00:00', $line->getBillingPeriodStart());
        self::assertSame('2021-04-30 00:00:00', $line->getBillingPeriodEnd());
        self::assertSame('2021-04-01 00:00:00', $line->getUsageStartDate());
        self::assertSame('2021-04-30 00:00:00', $line->getUsageEndDate());
        self::assertSame('2021-03-17 00:00:00', $line->getSubscriptionStartDate());
        self::assertSame('2022-03-17 00:00:00', $line->getSubscriptionEndDate());
        self::assertSame('Monthly', $line->getBillingPeriodicity());
        self::assertSame(4.0, $line->getQuantity());
        self::assertNull($line->getSubscriptionFriendlyName());
        self::assertSame('XSP123', $line->getArsSubscriptionId());
        self::assertSame('Offer Name', $line->getOfferName());
        self::assertSame(1.0, $line->getExchangeRate());
        self::assertSame(1.0874, $line->getEndCustomerRate());
        self::assertSame('uplift', $line->getEndCustomerRateType());
        self::assertSame('USD', $line->getVendorCurrency());
        self::assertSame(6.87, $line->getVendorRetailUnitBuyPrice());
        self::assertSame(27.48, $line->getVendorRetailTotalBuyPrice());
        self::assertSame(6.183, $line->getVendorResellerUnitBuyPrice());
        self::assertSame(24.732, $line->getVendorResellerTotalBuyPrice());
        self::assertSame(12.9064, $line->getVendorEndCustomerUnitBuyPrice());
        self::assertSame(51.6256, $line->getVendorEndCustomerTotalBuyPrice());
        self::assertSame('EUR', $line->getCountryCurrency());
        self::assertSame(4.1689, $line->getCountryRetailUnitBuyPrice());
        self::assertSame(16.6755, $line->getCountryRetailTotalBuyPrice());
        self::assertSame(4.6951, $line->getCountryResellerUnitBuyPrice());
        self::assertSame(18.7805, $line->getCountryResellerTotalBuyPrice());
        self::assertSame(9.8006, $line->getCountryEndCustomerUnitBuyPrice());
        self::assertSame(39.2024, $line->getCountryEndCustomerTotalBuyPrice());
        self::assertSame('Description', $line->getDescription());
    }
}
