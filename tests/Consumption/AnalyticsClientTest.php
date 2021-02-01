<?php

namespace ArrowSphere\PublicApiClient\Tests\Consumption;

use ArrowSphere\PublicApiClient\Consumption\AnalyticsClient;
use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use ArrowSphere\PublicApiClient\Tests\AbstractClientTest;
use GuzzleHttp\Psr7\Response;
use ReflectionException;

/**
 * Class AnalyticsClientTest
 *
 * @property AnalyticsClient $client
 */
class AnalyticsClientTest extends AbstractClientTest
{
    protected const MOCKED_CLIENT_CLASS = AnalyticsClient::class;

    /**
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function testGetMonthlyRaw(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/consumption/analytics/monthly?month=2020-05')
            ->willReturn(new Response(200, [], 'OK USA'));

        $this->client->getMonthlyRaw('2020-05');
    }

    /**
     * @depends testGetMonthlyRaw
     * @throws PublicApiClientException
     * @throws ReflectionException
     */
    public function testGetMonthlyForArrow(): void
    {
        $response = <<<JSON
{
    "status": 200,
    "data": [
        {
            "month": "2020-10",
            "marketplace": "FR",
            "vendor": "Microsoft",
            "classification": "SAAS",
            "tag": null,
            "usdPrice": {
                "arrowBuyPrice": 975550.55,
                "resellerBuyPrice": 1025302.09,
                "listBuyPrice": 1025302.09,
                "endCustomerBuyPrice": null,
                "currency": "USD"
            },
            "localPrice": {
                "arrowBuyPrice": 838778.34,
                "resellerBuyPrice": 881554.72,
                "listBuyPrice": 1025302.09,
                "endCustomerBuyPrice": 1025302.09,
                "currency": "EUR"
            }
        }
    ]
}
JSON;

        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/consumption/analytics/monthly?month=2020-10&classification%5B%5D=SAAS&vendor%5B%5D=Microsoft&marketplace%5B%5D=FR')
            ->willReturn(new Response(200, [], $response));

        $items = $this->client->getMonthly(
            '2020-10',
            ['SAAS'],
            ['Microsoft'],
            ['FR']
        );

        self::assertEquals('SAAS', $items[0]->getClassification());
        self::assertEquals('FR', $items[0]->getMarketPlace());
        self::assertEquals('Microsoft', $items[0]->getVendor());
        self::assertEquals('2020-10', $items[0]->getMonth());
        self::assertEquals('USD', $items[0]->getUsdPrice()->getCurrency());
        self::assertEquals(975550.55, $items[0]->getUsdPrice()->getArrowBuyPrice());
        self::assertEquals(1025302.09, $items[0]->getUsdPrice()->getResellerBuyPrice());
        self::assertEquals('EUR', $items[0]->getLocalPrice()->getCurrency());
        self::assertEquals(838778.34, $items[0]->getLocalPrice()->getArrowBuyPrice());
        self::assertEquals(881554.72, $items[0]->getLocalPrice()->getResellerBuyPrice());
    }

    /**
     * @depends testGetMonthlyRaw
     * @throws PublicApiClientException
     * @throws ReflectionException
     */
    public function testGetMonthlyForReseller(): void
    {
        $response = <<<JSON
{
    "status": 200,
    "data": [
        {
            "month": "2020-10",
            "marketplace": "FR",
            "vendor": "Microsoft",
            "classification": "SAAS",
            "tag": null,
            "usdPrice": {
                "resellerBuyPrice": 1025302.09,
                "listBuyPrice": 1025302.09,
                "endCustomerBuyPrice": null,
                "currency": "USD"
            },
            "localPrice": {
                "resellerBuyPrice": 881554.72,
                "listBuyPrice": 1025302.09,
                "endCustomerBuyPrice": 123,
                "currency": "EUR"
            }
        }
    ]
}
JSON;
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/consumption/analytics/monthly?month=2020-10&classification%5B%5D=SAAS&vendor%5B%5D=Microsoft&marketplace%5B%5D=FR')
            ->willReturn(new Response(200, [], $response));

        $items = $this->client->getMonthly(
            '2020-10',
            ['SAAS'],
            ['Microsoft'],
            ['FR']
        );

        self::assertEquals('SAAS', $items[0]->getClassification());
        self::assertEquals('FR', $items[0]->getMarketPlace());
        self::assertEquals('Microsoft', $items[0]->getVendor());
        self::assertEquals('2020-10', $items[0]->getMonth());
        self::assertEquals('USD', $items[0]->getUsdPrice()->getCurrency());
        self::assertNull($items[0]->getUsdPrice()->getArrowBuyPrice());
        self::assertEquals(1025302.09, $items[0]->getUsdPrice()->getResellerBuyPrice());
        self::assertEquals('EUR', $items[0]->getLocalPrice()->getCurrency());
        self::assertNull($items[0]->getLocalPrice()->getArrowBuyPrice());
        self::assertEquals(881554.72, $items[0]->getLocalPrice()->getResellerBuyPrice());
    }
}