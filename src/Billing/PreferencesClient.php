<?php

namespace ArrowSphere\PublicApiClient\Billing;

use ArrowSphere\PublicApiClient\Billing\Entities\Preference;
use ArrowSphere\PublicApiClient\Billing\Entities\Preferences;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;
use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
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
     * Returns a Preferences object
     *
     * @param string $period YYYY-MM
     *
     * @return Preferences
     *
     * @throws EntityValidationException
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function getPreferences(string $period): Preferences
    {
        $rawResponse = $this->getPreferencesRaw($period);
        $response = $this->decodeResponse($rawResponse);

        if (! isset($response['data'])) {
            throw new PublicApiClientException(sprintf('Error: Data not found in response. Raw response was: "%s"', $rawResponse));
        }

        return new Preferences($response['data']);
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
