<?php

namespace ArrowSphere\PublicApiClient\Contacts;

use ArrowSphere\PublicApiClient\AbstractClient;
use ArrowSphere\PublicApiClient\Contacts\Entities\VendorContact;
use ArrowSphere\PublicApiClient\Entities\Exception\EntitiesException;
use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use Generator;
use GuzzleHttp\Exception\GuzzleException;
use InvalidArgumentException;

/**
 * Class ContactsClient
 */
class ContactsClient extends AbstractClient
{
    /**
     * @param array $parameters Optional parameters to add to the URL. Must include the "vendor" parameter.
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

    /**
     * Lists the vendor contacts of the end customers.
     * Actually, this method is only usable with the Adobe vendor "VIP-MP".
     * Returns an array (Generator) of VendorContact.
     *
     * @param array $parameters Optional parameters to add to the URL. Must include the "vendor" parameter.
     *
     * @return Generator<VendorContact>
     *
     * @throws EntitiesException
     * @throws GuzzleException
     * @throws InvalidArgumentException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function getVendorContacts(array $parameters = []): Generator
    {
        if (empty($parameters['vendor'])) {
            throw new InvalidArgumentException('The "vendor" parameter is required and cannot be empty.');
        }

        $this->setPerPage(100);
        $currentPage = 1;
        $lastPage = false;

        while (! $lastPage) {
            $this->setPage($currentPage);
            $rawResponse = $this->getContactsRaw($parameters);
            /** @var array{data: array[], pagination: array{total_page: int}} $response */
            $response = $this->decodeResponse($rawResponse);

            if ($response['pagination']['total_page'] <= $currentPage) {
                $lastPage = true;
            }

            $currentPage++;

            foreach ($response['data'] as $data) {
                yield new VendorContact($data);
            }
        }
    }
}
