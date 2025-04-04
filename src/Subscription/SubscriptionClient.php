<?php

namespace ArrowSphere\PublicApiClient\Subscription;

use ArrowSphere\PublicApiClient\AbstractClient;
use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use GuzzleHttp\Exception\GuzzleException;

class SubscriptionClient extends AbstractClient
{
    /**
     * @var string The base path of the Subscription API
     */
    protected const ROOT_PATH = '/subscriptions';

    /*
     * @var string The base path of the API
     */
    protected $basePath = self::ROOT_PATH;

    /**
     * Validate a subscription to a program.
     *
     * @param string $subscriptionRef The subscription reference
     * @param array $parameters Optional parameters to add to the URL
     *
     * @return void
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function validateSubscription(string $subscriptionRef, array $parameters = []): void
    {
        $this->path = '/' . urlencode($subscriptionRef) . '/validate';

        $this->post([], $parameters);
    }
}
