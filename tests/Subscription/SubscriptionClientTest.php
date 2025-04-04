<?php

namespace ArrowSphere\PublicApiClient\Tests\Subscription;

use ArrowSphere\PublicApiClient\Exception\EntityValidationException;
use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use ArrowSphere\PublicApiClient\Subscription\SubscriptionClient;
use ArrowSphere\PublicApiClient\Tests\AbstractClientTest;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;

/**
 * Class SubscriptionClientTest
 *
 * @property SubscriptionClient $client
 */
class SubscriptionClientTest extends AbstractClientTest
{
    protected const MOCKED_CLIENT_CLASS = SubscriptionClient::class;

    /**
     * @return void
     *
     * @throws EntityValidationException
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function testCreateInvitation(): void
    {
        $payload = [];

        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('post', 'https://www.test.com/subscriptions/XSPS123/validate', [
                'headers' => [
                    'apiKey' => '123456',
                    'Content-Type' => 'application/json',
                    'User-Agent' => $this->userAgentHeader,
                ],
                'body'    => json_encode($payload),
            ])
            ->willReturn(new Response(200, []));

        $this->client->validateSubscription('XSPS123');
    }
}
