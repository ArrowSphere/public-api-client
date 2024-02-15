<?php

namespace ArrowSphere\PublicApiClient\Notification;

use ArrowSphere\PublicApiClient\AbstractClient;

/**
 * Class AbstractNotificationClient for interacting with the Notification endpoints
 */
abstract class AbstractNotificationClient extends AbstractClient
{
    /**
     * @var string The base path of the Cart API
     */
    protected const ROOT_PATH = '/notification';

    /**
     * @var string The body index name returned
     */
    protected const NOTIFICATIONS = 'notifications';

    /**
     * @var string In case of pagination it is set with last notif id
     */
    protected const SEARCH_AFTER = 'searchAfter';

    /**
     * The path of the API notif patch endpoints
     */
    protected const READ = 'read';

    /**
     * @var string The base path of the API
     */
    protected $basePath = self::ROOT_PATH;
}
