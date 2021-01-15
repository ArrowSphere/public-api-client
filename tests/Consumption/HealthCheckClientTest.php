<?php

namespace ArrowSphere\PublicApiClient\Tests\Consumption;

use ArrowSphere\PublicApiClient\Consumption\HealthCheckClient;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;
use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use ArrowSphere\PublicApiClient\Tests\AbstractClientTest;
use ReflectionException;

/**
 * Class OfferClientTest
 *
 * @property HealthCheckClient $client
 */
class HealthCheckClientTest extends AbstractClientTest
{
    protected const MOCKED_CLIENT_CLASS = HealthCheckClient::class;

    /**
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function testGetItemRaw() : void
    {
        $this->curler->response = 'OK USA';

        $this->curler->expects(self::once())
            ->method('get')
            ->with('https://www.test.com/consumption/healthcheck?');

        $this->client->getItemRaw();
    }

    /**
     * @depends testGetItemRaw
     * @throws EntityValidationException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function testGetItem(): void
    {
        $this->curler->response = <<<JSON
{
    "status": 200,
    "data": {
        "details": [
            {
                "vendor": "Microsoft",
                "marketplace": "FR",
                "classification": "SAAS",
                "color": "green",
                "message": "OK"
            }
        ]
    }
}
JSON;
        $this->curler->expects(self::once())
            ->method('get')
            ->with('https://www.test.com/consumption/healthcheck?classification%5B%5D=SAAS&vendor%5B%5D=Microsoft&marketplace%5B%5D=FR');

        $items = $this->client->getItem(
            ['SAAS'],
            ['Microsoft'],
            ['FR']
        );

        self::assertEquals('SAAS', $items[0]->getClassification());
        self::assertEquals('green', $items[0]->getColor());
        self::assertEquals('FR', $items[0]->getMarketPlace());
        self::assertEquals('OK', $items[0]->getMessage());
        self::assertEquals('Microsoft', $items[0]->getVendor());
    }

    /**
     * @throws EntityValidationException
     * @throws NotFoundException
     * @throws PublicApiClientException|ReflectionException
     */
    public function testGetItemWithBadColor(): void
    {
        $this->expectException(EntityValidationException::class);
        $this->curler->response = <<<JSON
{
    "status": 200,
    "data": {
        "details": [
            {
                "vendor": "Microsoft",
                "marketplace": "FR",
                "classification": "SAAS",
                "color": "blue",
                "message": "OK"
            }
        ]
    }
}
JSON;
        $this->curler->expects(self::once())
            ->method('get')
            ->with('https://www.test.com/consumption/healthcheck?classification%5B%5D=SAAS&vendor%5B%5D=Microsoft&marketplace%5B%5D=FR');

        $this->client->getItem(
            ['SAAS'],
            ['Microsoft'],
            ['FR']
        );
    }

    /**
     * @throws EntityValidationException
     * @throws NotFoundException
     * @throws PublicApiClientException|ReflectionException
     */
    public function testGetItemWithBadAttribute(): void
    {
        $this->expectException(EntityValidationException::class);
        $this->expectExceptionMessage('classification is required');
        $this->curler->response = <<<JSON
{
    "status": 200,
    "data": {
        "details": [
            {
                "vendor": "Microsoft",
                "marketplace": "FR",
                "color": "red",
                "message": "OK"
            }
        ]
    }
}
JSON;
        $this->curler->expects(self::once())
            ->method('get')
            ->with('https://www.test.com/consumption/healthcheck?classification%5B%5D=SAAS&vendor%5B%5D=Microsoft&marketplace%5B%5D=FR');

        $this->client->getItem(
            ['SAAS'],
            ['Microsoft'],
            ['FR']
        );
    }
}