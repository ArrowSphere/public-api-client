<?php

namespace ArrowSphere\PublicApiClient\Billing;

use ArrowSphere\PublicApiClient\AbstractClient;

/**
 * Class AbstractBillingClient for interacting with the Billing endpoints
 */
class AbstractBillingClient extends AbstractClient
{
    /**
     * @var string The base path of the billing API
     */
    private const ROOT_PATH = '/billing';

    /**
     * @var string The keyword for number of results per page for pagination
     */
    protected const PER_PAGE = 'perPage';

    /**
     * @var string The base path of the API
     */
    protected $basePath = self::ROOT_PATH;
}
