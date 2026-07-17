<?php

namespace ArrowSphere\PublicApiClient\Partners;

use ArrowSphere\PublicApiClient\AbstractClient;
use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use GuzzleHttp\Exception\GuzzleException;

class PartnersClient extends AbstractClient
{
    /**
     * @var string The base path of the API
     */
    protected $basePath = '/partners';

    /**
     * @param array $parameters Optional parameters to add to the URL
     *
     * @return string
     *
     * @throws PublicApiClientException
     * @throws NotFoundException
     * @throws GuzzleException
     */
    public function getContactsRaw(array $parameters = []): string
    {
        $this->path = '/contacts';

        return $this->get($parameters);
    }
}
