<?php

namespace ArrowSphere\PublicApiClient\Notification;

use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use GuzzleHttp\Exception\GuzzleException;

class NotificationClient extends AbstractNotificationClient
{
    /**
     * @param string $id
     *
     * @return array|null
     *
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function getOneNotification(string $id): ?array
    {
        $this->path = '/' . urlencode($id);
        $response = $this->get();

        return $this->getResponseData($response)[self::NOTIFICATIONS][0];
    }

    /**
     * @param array $filterQueryData
     *
     * @return array
     *
     * @throws GuzzleException
     * @throws PublicApiClientException
     */
    public function listNotifications(array $filterQueryData = []): array
    {
        $this->path = '';
        $response = $this->get($filterQueryData);

        return [
            self::NOTIFICATIONS => $this->getResponseData($response)[self::NOTIFICATIONS] ?? [],
            self::SEARCH_AFTER  => $this->decodeResponse($response)['pagination'][self::SEARCH_AFTER] ?? 'done'
        ];
    }

    /**
     * @param string $id
     *
     * @return string
     *
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function readOneNotification(string $id): string
    {
        $this->path = '/' . urlencode($id) . '/' . self::READ;

        return $this->patch([]);
    }

    /**
     * @return string
     *
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function readAllNotifications(): string
    {
        $this->path = '/' . self::READ;

        return $this->patch([]);
    }

    /**
     * @param array $payload
     *
     * @return array
     *
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function createNotification(array $payload): array
    {
        $this->path = '';

        if (! empty($this->username)) {
            $this->username = null;
        }

        $response = $this->post($payload);

        return $this->getResponseData($response)['notification'][0];
    }

    /**
     * @param string $id
     *
     * @return string
     *
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function deleteOneNotification(string $id): string
    {
        $this->path = '/' . urlencode($id);

        return $this->delete();
    }

    /**
     * @return string
     *
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function deleteAllNotifications(): string
    {
        $this->path = '/';

        return $this->delete();
    }

    /**
     * @param array $data
     *
     * @return string
     *
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function countNotifications(array $data = []): string
    {
        $this->path = '/count';
        $response = $this->get($data);

        return $this->getResponseData($response)['total'];
    }
}
