<?php

namespace ArrowSphere\PublicApiClient\Subscription;

use ArrowSphere\PublicApiClient\AbstractClient;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;
use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use ArrowSphere\PublicApiClient\Subscription\Entities\Subscription;
use Generator;
use GuzzleHttp\Exception\GuzzleException;


class SubscriptionClient extends AbstractClient
{
    /**
     * @param array $parameters Optional parameters to add to the URL
     *
     * @return string
     *
     * @throws PublicApiClientException
     * @throws NotFoundException
     * @throws GuzzleException
     */
    public function getSubscriptionsRaw(array $parameters = []): string
    {
        $this->path = '/subscriptions';

        return $this->get($parameters);
    }

    /**
     * Returns an array (generator) of Subscription.
     *
     * @param array $parameters Optional parameters to add to the URL
     *
     * @return Generator|Subscription[]
     *
     * @throws EntityValidationException
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function getSubscriptions(array $parameters = []): Generator
    {
        $this->setPerPage(100);
        $currentPage = 1;
        $lastPage = false;

        while (! $lastPage) {
            $this->setPage($currentPage);
            $rawResponse = $this->getSubscriptionsRaw($parameters);
            $response = $this->decodeResponse($rawResponse);

            if ($response['pagination']['total_page'] <= $currentPage) {
                $lastPage = true;
            }

            $currentPage++;

            foreach ($response['data']['subscriptions'] as $data) {
                yield new Subscription($data);
            }
        }
    }

    /**
     * @param array        $parameters Optional parameters to add to the URL
     * @param Subscription $subscription
     *
     * @return string
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function createSubscription(Subscription $subscription, array $parameters = []): string
    {
        $payload = $subscription->jsonSerialize();

        $this->path = '/subscriptions';

        $rawResponse = $this->post($payload, $parameters);

        $response = $this->decodeResponse($rawResponse);

        return $response['data']['reference'];
    }
}
