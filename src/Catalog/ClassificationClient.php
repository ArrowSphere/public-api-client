<?php

namespace ArrowSphere\PublicApiClient\Catalog;

use ArrowSphere\PublicApiClient\Catalog\Entities\Classification;
use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use Generator;

/**
 * Class ClassificationClient
 */
class ClassificationClient extends AbstractCatalogClient
{
    /**
     * @return string
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function getClassificationsRaw(): string
    {
        $this->path = '/categories';

        return $this->get();
    }

    /**
     * Provides all classifications.
     * Returns an array (generator) of Classification.
     *
     * @return Generator|Classification[]
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function getClassifications(): Generator
    {
        $rawResponse = $this->getClassificationsRaw();
        $response = $this->decodeResponse($rawResponse);

        foreach ($response['data'] as $data) {
            yield new Classification($data);
        }
    }
}
