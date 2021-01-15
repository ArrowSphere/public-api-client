<?php


namespace ArrowSphere\PublicApiClient\Licenses;

use ArrowSphere\PublicApiClient\AbstractClient;

/**
 * Class AbstractCatalogClient for interacting with the Catalog endpoints
 *
 * @package ArrowSphere\PublicApiClient
 */
class AbstractLicensesClient extends AbstractClient
{
    /** @var string The base path of the Catalog API */
    private const ROOT_PATH = '/licenses';

    /** @var string The base path of the API */
    protected $basePath = self::ROOT_PATH;
}