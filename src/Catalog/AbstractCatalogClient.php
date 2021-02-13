<?php

namespace ArrowSphere\PublicApiClient\Catalog;

use ArrowSphere\PublicApiClient\AbstractClient;

/**
 * Class AbstractCatalogClient for interacting with the Catalog endpoints
 */
class AbstractCatalogClient extends AbstractClient
{
    /**
     * @var string The base path of the Catalog API
     */
    private const ROOT_PATH = '/catalog';

    /**
     * @var string The base path of the API
     */
    protected $basePath = self::ROOT_PATH;
}
