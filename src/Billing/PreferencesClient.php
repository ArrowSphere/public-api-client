<?php

namespace ArrowSphere\PublicApiClient\Billing;

use ArrowSphere\PublicApiClient\Billing\Entities\Preference;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;
use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use Generator;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Class PreferencesClient
 */
class PreferencesClient extends AbstractBillingClient
{
    /**
     * Creates preferences.
     *
     * @param string $period YYYY-MM
     * @param Preference[] $preferences
     *
     * @return void
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function createPreferences(string $period, array $preferences): void
    {
        $payload = array_map(static function (Preference $preference) {
            return $preference->jsonSerialize();
        }, $preferences);

        $period = urlencode($period);

        $this->path = "/preferences/$period";

        $this->post($payload);
    }

    /**
     * Lists the preferences.
     * Returns an array (generator) of Preference.
     *
     * @param string $period YYYY-MM
     *
     * @return Generator|Preference[]
     *
     * @throws EntityValidationException
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function getPreferences(string $period): Generator
    {
        $rawResponse = $this->getPreferencesRaw($period);
        $response = $this->decodeResponse($rawResponse);

        if (! isset($response['data']['preferences'])) {
            throw new PublicApiClientException(sprintf('Error: Data not found in response. Raw response was: "%s"', $rawResponse));
        }

        foreach ($response['data']['preferences'] as $data) {
            yield new Preference($data);
        }
    }

    /**
     * @param string $period YYYY-MM
     *
     * @return string
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function getPreferencesRaw(string $period): string
    {
        $period = urlencode($period);

        $this->path = "/preferences/$period";

        return $this->get();
    }
}
