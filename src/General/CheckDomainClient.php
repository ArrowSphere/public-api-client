<?php

namespace ArrowSphere\PublicApiClient\General;

use ArrowSphere\PublicApiClient\AbstractClient;
use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Class CheckDomainClient
 */
class CheckDomainClient extends AbstractClient
{
    /**
     * @param string $vendorName The vendor's name
     * @param string $domainName The domain to check
     * @param array $parameters Optional parameters to add to the URL
     *
     * @return string
     *
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function checkDomainRaw(string $vendorName, string $domainName, array $parameters = []): string
    {
        $this->path = sprintf(
            '/vendors/%s/checkDomain/%s',
            urlencode($vendorName),
            urlencode($domainName)
        );

        return $this->get($parameters);
    }

    /**
     * @param string $vendorName The vendor's name
     * @param string $domainName The domain to check
     * @param array $parameters Optional parameters to add to the URL
     *
     * @return bool
     *
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function checkDomain(string $vendorName, string $domainName, array $parameters = []): bool
    {
        $rawResponse = $this->checkDomainRaw($vendorName, $domainName, $parameters);
        $response = $this->decodeResponse($rawResponse);

        return $response['data']['isDomainAvailable'];
    }
}
