<?php

namespace ArrowSphere\PublicApiClient\Tests\Billing;

use ArrowSphere\PublicApiClient\Billing\Entities\Preference;
use ArrowSphere\PublicApiClient\Billing\Entities\Preferences;
use ArrowSphere\PublicApiClient\Billing\PreferencesClient;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;
use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use ArrowSphere\PublicApiClient\Tests\AbstractClientTest;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;

/**
 * Class PreferencesClientTest
 *
 * @property PreferencesClient $client
 */
class PreferencesClientTest extends AbstractClientTest
{
    protected const MOCKED_CLIENT_CLASS = PreferencesClient::class;

    /**
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws EntityValidationException
     * @throws GuzzleException
     */
    public function testGetPreferences(): void
    {
        $period = '2020-04';

        $response = json_encode([
            'status' => 0,
            'data' => [
                'preferences' => [
                    [
                        'name' => 'rule42',
                        'priority' => 1,
                        'identifier' => 'GroupBy',
                        'parameters' => [
                            'columns' => [
                                'ResourceGroup',
                            ],
                        ],
                        'filters' => [],
                        'overrides' => [
                            'ArsSku' => 'foobar',
                        ],
                    ]
                ],
                'validity' => [
                    'usable' => true,
                    'status' => 'OK',
                ],
            ],
        ]);

        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/billing/preferences/2020-04', [
                'headers' => [
                    'apiKey' => '123456',
                    'Content-Type' => 'application/json',
                    'User-Agent' => $this->userAgentHeader,
                ],
            ])
            ->willReturn(new Response(200, [], $response));

        /** @var Preferences $preferences */
        $preferences = $this->client->getPreferences($period);
        $list = $preferences->getList();
        self::assertCount(1, $list);

        $preference = array_shift($list);
        self::assertInstanceOf(Preference::class, $preference);
        self::assertSame('GroupBy', $preference->getIdentifier());
        self::assertSame([
            'columns' => [
                'ResourceGroup',
            ],
        ], $preference->getParameters());

        self::assertTrue($preferences->getUsable());
        self::assertSame('OK', $preferences->getStatus());
    }

    /**
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws EntityValidationException
     * @throws GuzzleException
     */
    /*public function testCreatePreferences(): void//TODO check with dev why this tests not working
    {
        $payload = [
            'name' => 'rule42',
            'priority' => 1,
            'identifier' => 'GroupBy',
            'parameters' => [
                'columns' => [
                    'ResourceGroup',
                ],
            ],
            'filters' => [],
            'overrides' => [
                'ArsSku' => 'foobar',
            ],
        ];

        $preference = new Preference($payload);
        $period = '2020-04';

        $response = json_encode([
            'status' => 0,
            'data' => []
        ]);

        $payload['filters'] = (object)[];

        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('post', 'https://www.test.com/billing/preferences/2020-04', [
                'headers' => [
                    'apiKey' => '123456',
                    'Content-Type' => 'application/json',
                ],
                'body'    => '[' . json_encode($payload) . ']',
            ])
            ->willReturn(new Response(204, [], $response));

        $this->client->createPreferences($period, [$preference]);
    }*/

    /**
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws EntityValidationException
     * @throws GuzzleException
     */
    public function testCreateInvalidPreferences(): void
    {
        $payload = [
            'identifier' => 'GroupBy',
            'parameters' => [], // columns is required
        ];

        $this->expectException(EntityValidationException::class);
        $preference = new Preference($payload);
    }

    /**
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws EntityValidationException
     * @throws GuzzleException
     */
    public function testCreateInvalidColumnsPreferences(): void
    {
        $payload = [
            'identifier' => 'GroupBy',
            'parameters' => [
                'columns' => [
                    'FooBar', // FooBar does not exist
                ],
            ],
        ];

        $this->expectException(EntityValidationException::class);
        $preference = new Preference($payload);
    }
}
