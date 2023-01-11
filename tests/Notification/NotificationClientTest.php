<?php

namespace ArrowSphere\PublicApiClient\Tests\Notification;

use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use ArrowSphere\PublicApiClient\Notification\NotificationClient;
use ArrowSphere\PublicApiClient\Tests\AbstractClientTest;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;

/**
 * Class NotificationClientTest
 *
 * @property NotificationClient $client
 */
class NotificationClientTest extends AbstractClientTest
{
    use NotificationMockedDataTrait;

    protected const MOCKED_CLIENT_CLASS = NotificationClient::class;

    /**
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function testListNotifications(): void
    {
        $this->client->setIdToken($this->idToken);
        $this->client->setDefaultHeaders($this->generateDefaultHeaders());
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/notification')
            ->willReturn(new Response(200, [], json_encode($this->generateMockedNotification())));

        $this->client->listNotifications();
    }

    /**
     * @throws NotFoundException
     * @throws GuzzleException
     * @throws PublicApiClientException
     */
    public function testReadOneNotification(): void
    {
        $id = $this->id;
        $this->client->setIdToken($this->idToken);
        $this->client->setDefaultHeaders($this->generateDefaultHeaders());
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('patch', "https://www.test.com/notification/$id/read")
            ->willReturn(new Response(204, []));

        $this->client->readOneNotification($id);
    }

    /**
     * @throws NotFoundException
     * @throws GuzzleException
     * @throws PublicApiClientException
     */
    public function testReadAllNotifications(): void
    {
        $this->client->setIdToken($this->idToken);
        $this->client->setDefaultHeaders($this->generateDefaultHeaders());
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('patch', "https://www.test.com/notification/read")
            ->willReturn(new Response(204, []));

        $this->client->readAllNotifications();
    }

    /**
     * @throws NotFoundException
     * @throws GuzzleException
     * @throws PublicApiClientException
     */
    public function testDeleteOneNotification(): void
    {
        $id = $this->id;
        $this->client->setIdToken($this->idToken);
        $this->client->setDefaultHeaders($this->generateDefaultHeaders());
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('delete', "https://www.test.com/notification/$id")
            ->willReturn(new Response(204, []));

        $this->client->deleteOneNotification($id);
    }

    /**
     * @throws NotFoundException
     * @throws GuzzleException
     * @throws PublicApiClientException
     */
    public function testDeleteAllNotifications(): void
    {
        $this->client->setIdToken($this->idToken);
        $this->client->setDefaultHeaders($this->generateDefaultHeaders());
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('delete', "https://www.test.com/notification/")
            ->willReturn(new Response(204, []));

        $this->client->deleteAllNotifications();
    }
}
