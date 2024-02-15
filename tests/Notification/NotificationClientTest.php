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
    protected const MOCKED_CLIENT_CLASS = NotificationClient::class;

    private const NOTIFICATION_ID = '70993353-0db8-4d12-8880-d6eece73f93f';

    /**
     * @return array
     */
    public function generateMockedNotification(): array
    {
        return [
            'id'          => self::NOTIFICATION_ID,
            'userName'    => 'beatrice kido',
            'created'     => 6765765372,
            'expires'     => 8787687655,
            'subject'     => 'Order fulfilled - [XSP656567]',
            'content'     => 'Your order has been fulfilled with success',
            'hasBeenRead' => 0
        ];
    }

    /**
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function testListNotifications(): void
    {
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
        $id = self::NOTIFICATION_ID;
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
        $id = self::NOTIFICATION_ID;
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
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('delete', "https://www.test.com/notification/")
            ->willReturn(new Response(204, []));

        $this->client->deleteAllNotifications();
    }
}
