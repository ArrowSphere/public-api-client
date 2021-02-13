<?php

namespace ArrowSphere\PublicApiClient\General;

use ArrowSphere\PublicApiClient\AbstractClient;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;
use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use ArrowSphere\PublicApiClient\General\Entities\Whoami;

class WhoamiClient extends AbstractClient
{
    /**
     * @return string
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function getWhoamiRaw(): string
    {
        $this->path = '/whoami';

        return $this->get();
    }

    /**
     * @return Whoami
     *
     * @throws EntityValidationException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function getWhoami(): Whoami
    {
        $rawResponse = $this->getWhoamiRaw();
        $response = $this->decodeResponse($rawResponse);

        return new Whoami($response['data']);
    }
}
