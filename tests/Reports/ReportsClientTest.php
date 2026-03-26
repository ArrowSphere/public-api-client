<?php

namespace ArrowSphere\PublicApiClient\Tests\Reports;

use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use ArrowSphere\PublicApiClient\Reports\ReportsClient;
use ArrowSphere\PublicApiClient\Tests\AbstractClientTest;
use GuzzleHttp\Psr7\Response;

/**
 * Class ReportsClientTest
 *
 * @property ReportsClient $client
 */
class ReportsClientTest extends AbstractClientTest
{
    protected const MOCKED_CLIENT_CLASS = ReportsClient::class;

    /**
     * @throws PublicApiClientException
     */
    public function testValidateReportRaw(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with(
                'patch',
                'https://www.test.com/reports/XSPR123',
                self::callback(static function (array $options) {
                    return $options['body'] === '[]';
                })
            )
            ->willReturn(new Response(200, [], 'OK'));

        $this->client->validateReportRaw('XSPR123');
    }

    /**
     * @depends testValidateReportRaw
     *
     * @throws PublicApiClientException
     */
    public function testValidateReportWithInvalidResponse(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with(
                'patch',
                'https://www.test.com/reports/XSPR123'
            )
            ->willReturn(new Response(200, [], '{'));

        $this->expectException(PublicApiClientException::class);
        $this->client->validateReport('XSPR123');
    }

    /**
     * @depends testValidateReportWithInvalidResponse
     *
     * @throws PublicApiClientException
     */
    public function testValidateReport(): void
    {
        $response = <<<JSON
{
  "status": 200,
  "data": {
    "orders": [
      {
        "reference": "XSPO123",
        "link": "api/orderSoftware/XSPO1234",
        "status": "In progress"
      }
    ]
  }
}
JSON;

        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with(
                'patch',
                'https://www.test.com/reports/XSPR123'
            )
            ->willReturn(new Response(200, [], $response));

        $result = $this->client->validateReport('XSPR123');

        $orders = $result->getOrders();
        self::assertCount(1, $orders);

        $order = $orders[0];
        self::assertEquals('XSPO123', $order->getReference());
        self::assertEquals('api/orderSoftware/XSPO1234', $order->getLink());
        self::assertEquals('In progress', $order->getStatus());
    }

    /**
     * @depends testValidateReportWithInvalidResponse
     *
     * @throws PublicApiClientException
     */
    public function testValidateReportWithMultipleOrders(): void
    {
        $response = <<<JSON
{
  "status": 200,
  "data": {
    "orders": [
      {
        "reference": "XSPO001",
        "link": "api/orderSoftware/XSPO001",
        "status": "In progress"
      },
      {
        "reference": "XSPO002",
        "link": "api/orderSoftware/XSPO002",
        "status": "Completed"
      }
    ]
  }
}
JSON;

        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with(
                'patch',
                'https://www.test.com/reports/XSPR456'
            )
            ->willReturn(new Response(200, [], $response));

        $result = $this->client->validateReport('XSPR456');

        $orders = $result->getOrders();
        self::assertCount(2, $orders);

        self::assertEquals('XSPO001', $orders[0]->getReference());
        self::assertEquals('In progress', $orders[0]->getStatus());

        self::assertEquals('XSPO002', $orders[1]->getReference());
        self::assertEquals('Completed', $orders[1]->getStatus());
    }
}
