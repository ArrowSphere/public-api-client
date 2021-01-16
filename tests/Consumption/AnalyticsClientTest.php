<?php

namespace ArrowSphere\PublicApiClient\Tests\Consumption;

use ArrowSphere\PublicApiClient\Consumption\AnalyticsClient;
use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use ArrowSphere\PublicApiClient\Tests\AbstractClientTest;

/**
 * Class AnalyticsClientTest
 * @package ArrowSphere\PublicApiClient\Tests\Consumption
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
    public function testGetMonthlyRaw() : void
    {
        $this->curler->response = 'OK USA';

        $this->curler->expects(self::once())
            ->method('get')
            ->with('https://www.test.com/consumption/analytics/monthly?month=2020-05');

        $this->client->getMonthlyRaw('2020-05');
    }

    public function testGetMonthlyForArrow(): void
    {
        $this->curler->response = <<<JSON
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
                "currency": "USD"
            },
            "localPrice": {
                "arrowBuyPrice": 838778.34,
                "resellerBuyPrice": 881554.72,
                "currency": "EUR"
            }
        }
    ]
}
JSON;
        $this->curler->expects(self::once())
            ->method('get')
            ->with('https://www.test.com/consumption/analytics/monthly?month=2020-10&classification%5B%5D=SAAS&vendor%5B%5D=Microsoft&marketplace%5B%5D=FR');

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

    public function testGetMonthlyForReseller(): void
    {
        $this->curler->response = <<<JSON
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
                "currency": "USD"
            },
            "localPrice": {
                "resellerBuyPrice": 881554.72,
                "currency": "EUR"
            }
        }
    ]
}
JSON;
        $this->curler->expects(self::once())
            ->method('get')
            ->with('https://www.test.com/consumption/analytics/monthly?month=2020-10&classification%5B%5D=SAAS&vendor%5B%5D=Microsoft&marketplace%5B%5D=FR');

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