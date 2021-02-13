<?php

namespace ArrowSphere\PublicApiClient\Consumption;

use ArrowSphere\PublicApiClient\AbstractClient;

/**
 * Class AbstractConsumptionClient for interacting with the Consumption endpoints
 */
class AbstractConsumptionClient extends AbstractClient
{
    /**
     * @var string The base path of the consumption API
     */
    private const ROOT_PATH = '/consumption';

    /**
     * @var string The base path of the API
     */
    protected $basePath = self::ROOT_PATH;
}
