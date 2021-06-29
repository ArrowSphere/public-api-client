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
                    'billingGroup' => 'ArrowBilling',
                    'vendorName' => 'microsoft',
                    'classification' => 'saas',
                    'reportPeriod' => '2021-04',
                    'marketplace' => 'US',
                    'issueDate' => '2021-04-29 13:37:00',
                    'from' => [
                        'reference' => 'XSP1337',
                        'name' => 'Reseller',
                    ],
                    'to' => [
                        'reference' => 'XSP123',
                        'name' => 'Customer',
                    ],
                    'currency' => 'USD',
                    'prices' => [
                        'buyTotal' => 42.0,
                        'sellTotal' => 23.1,
                    ],
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
        self::assertSame('ArrowBilling', $statement->getBillingGroup());
        self::assertSame('microsoft', $statement->getVendorName());
        self::assertSame('saas', $statement->getClassification());
        self::assertSame('2021-04-29 13:37:00', $statement->getIssueDate());
        self::assertSame('US', $statement->getMarketplace());
        self::assertSame(42.0, $statement->getPrices()->getBuyTotal());
        self::assertSame(23.1, $statement->getPrices()->getSellTotal());
        self::assertSame('XSP1337', $statement->getFrom()->getReference());
        self::assertSame('XSP123', $statement->getTo()->getReference());
        self::assertSame('Reseller', $statement->getFrom()->getName());
        self::assertSame('Customer', $statement->getTo()->getName());
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
                        'billingGroup' => 'ArrowBilling',
                        'vendorName' => 'microsoft',
                        'classification' => 'saas',
                        'reportPeriod' => '2021-04',
                        'marketplace' => 'US',
                        'issueDate' => '2021-04-29 13:37:00',
                        'from' => [
                            'reference' => 'XSP1337',
                            'name' => 'Reseller',
                        ],
                        'to' => [
                            'reference' => 'XSP123',
                            'name' => 'Customer',
                        ],
                        'currency' => 'USD',
                        'prices' => [
                            'buyTotal' => 42.0,
                            'sellTotal' => 23.1,
                        ],
                    ],
                    [
                        'reference' => 'H1-BBB-deadbeefdeadbeefdeadbeefdeadbeef',
                        'billingGroup' => 'ArrowBilling',
                        'vendorName' => 'microsoft',
                        'classification' => 'saas',
                        'reportPeriod' => '2021-04',
                        'marketplace' => 'US',
                        'issueDate' => '2021-04-29 13:37:00',
                        'from' => [
                            'reference' => 'XSP1337',
                            'name' => 'Reseller',
                        ],
                        'to' => [
                            'reference' => 'XSP123',
                            'name' => 'Customer',
                        ],
                        'currency' => 'USD',
                        'prices' => [
                            'buyTotal' => 42.0,
                            'sellTotal' => 23.1,
                        ],
                    ],
                    [
                        'reference' => 'H1-CCC-deadbeefdeadbeefdeadbeefdeadbeef',
                        'billingGroup' => 'ArrowBilling',
                        'vendorName' => 'microsoft',
                        'classification' => 'saas',
                        'reportPeriod' => '2021-04',
                        'marketplace' => 'US',
                        'issueDate' => '2021-04-29 13:37:00',
                        'from' => [
                            'reference' => 'XSP1337',
                            'name' => 'Reseller',
                        ],
                        'to' => [
                            'reference' => 'XSP123',
                            'name' => 'Customer',
                        ],
                        'currency' => 'USD',
                        'prices' => [
                            'buyTotal' => 42.0,
                            'sellTotal' => 23.1,
                        ],
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
        self::assertSame('microsoft', $statement->getVendorName());
        self::assertSame('ArrowBilling', $statement->getBillingGroup());
        self::assertSame('saas', $statement->getClassification());
        self::assertSame('2021-04', $statement->getReportPeriod());
        self::assertSame('2021-04-29 13:37:00', $statement->getIssueDate());
        self::assertSame('US', $statement->getMarketplace());
        self::assertSame('USD', $statement->getCurrency());
        self::assertSame(42.0, $statement->getPrices()->getBuyTotal());
        self::assertSame(23.1, $statement->getPrices()->getSellTotal());

        $from = $statement->getFrom();
        self::assertInstanceOf(Identity::class, $from);
        self::assertSame('XSP1337', $from->getReference());
        self::assertSame('Reseller', $from->getName());

        $to = $statement->getTo();
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
                    [
                        'reference' => 'H1-BBB-deadbeefdeadbeefdeadbeefdeadbeef',
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
                    [
                        'reference' => 'H1-CCC-deadbeefdeadbeefdeadbeefdeadbeef',
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
        self::assertSame('Vendor', $line->getVendorName());
        self::assertSame('Program', $line->getVendorProgram());
        self::assertSame('SAAS', $line->getVendorProgramClassification());
        self::assertSame('Product Name', $line->getVendorProductName());
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
        self::assertNull($line->getSubscriptionFriendlyName());
        self::assertSame('XSP123', $line->getArsSubscriptionId());
        self::assertSame('Offer Name', $line->getOfferName());
        self::assertSame(1.0874, $line->getRates()->getSellRate());
        self::assertSame('uplift', $line->getRates()->getSellRateType());
        self::assertSame(4.0, $line->getQuantity());
        self::assertSame('EUR', $line->getCurrency());
        self::assertSame(4.1689, $line->getPrices()->getListUnit());
        self::assertSame(16.6755, $line->getPrices()->getListTotal());
        self::assertSame(4.6951, $line->getPrices()->getBuyUnit());
        self::assertSame(18.7805, $line->getPrices()->getBuyTotal());
        self::assertSame(9.8006, $line->getPrices()->getSellUnit());
        self::assertSame(39.2024, $line->getPrices()->getSellTotal());
    }
}
