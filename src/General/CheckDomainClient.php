<?php

namespace ArrowSphere\PublicApiClient\General;

use ArrowSphere\PublicApiClient\AbstractClient;
use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;

/**
 * Class CheckDomainClient
 */
class CheckDomainClient extends AbstractClient
{
    /**
     * @param string $vendorName
     * @param string $domainName
     * @return string
     * @throws PublicApiClientException
     * @throws NotFoundException
     */
    public function checkDomainRaw(string $vendorName, string $domainName): string
    {
        $this->path = sprintf(
            '/vendors/%s/checkDomain/%s',
            urlencode($vendorName),
            urlencode($domainName)
        );

        return $this->get();
    }

    /**
     * @param string $vendorName
     * @param string $domainName
     * @return bool
     * @throws PublicApiClientException
     */
    public function checkDomain(string $vendorName, string $domainName): bool
    {
        $rawResponse = $this->checkDomainRaw($vendorName, $domainName);
        $response = $this->decodeResponse($rawResponse);

        return $response['data']['isDomainAvailable'];
    }
}
