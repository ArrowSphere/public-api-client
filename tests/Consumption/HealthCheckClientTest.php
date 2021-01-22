<?php

namespace ArrowSphere\PublicApiClient\Tests\Consumption;

use ArrowSphere\PublicApiClient\Consumption\HealthCheckClient;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;
use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use ArrowSphere\PublicApiClient\Tests\AbstractClientTest;
use GuzzleHttp\Psr7\Response;
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
        $this->httpClient
            ->expects(self::once())
            ->method('get')
            ->with('https://www.test.com/consumption/healthcheck?')
            ->willReturn(new Response(200, [], 'OK USA'));

        $this->client->getItemRaw();
    }

    /**
     * @depends testGetItemRaw
     * @throws EntityValidationException
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws ReflectionException
     */
    public function testGetItem(): void
    {
        $response = <<<JSON
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
        $this->httpClient
            ->expects(self::once())
            ->method('get')
            ->with('https://www.test.com/consumption/healthcheck?classification%5B%5D=SAAS&vendor%5B%5D=Microsoft&marketplace%5B%5D=FR')
            ->willReturn(new Response(200, [], $response));

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
        $response = <<<JSON
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

        $this->httpClient
            ->expects(self::once())
            ->method('get')
            ->with('https://www.test.com/consumption/healthcheck?classification%5B%5D=SAAS&vendor%5B%5D=Microsoft&marketplace%5B%5D=FR')
            ->willReturn(new Response(200, [], $response));

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
        $response = <<<JSON
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

        $this->httpClient
            ->expects(self::once())
            ->method('get')
            ->with('https://www.test.com/consumption/healthcheck?classification%5B%5D=SAAS&vendor%5B%5D=Microsoft&marketplace%5B%5D=FR')
            ->willReturn(new Response(200, [], $response));

        $this->client->getItem(
            ['SAAS'],
            ['Microsoft'],
            ['FR']
        );
    }
}