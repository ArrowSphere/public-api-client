<?php

namespace ArrowSphere\PublicApiClient\Cart;

use ArrowSphere\PublicApiClient\AbstractClient;

/**
 * Class AbstractCartClient for interacting with the cart endpoints
 */
abstract class AbstractCartClient extends AbstractClient
{
    /**
     * @var string The base path of the Cart API
     */
    protected const ROOT_PATH = '/cart';

    /**
     * @var string The base path of the API
     */
    protected $basePath = self::ROOT_PATH;
}
