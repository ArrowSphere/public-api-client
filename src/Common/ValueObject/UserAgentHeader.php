<?php

namespace ArrowSphere\PublicApiClient\Common\ValueObject;

use Composer\InstalledVersions;
use Stringable;

/**
 * Holds the User-Agent header value.
 */
class UserAgentHeader implements Stringable
{
    private const FORMAT = 'ArrowSphereClient/%s PHP/%s %s';

    /**
     * @var string
     */
    private $value;

    public function __construct()
    {
        $this->value = trim(
            sprintf(
                self::FORMAT,
                InstalledVersions::getPrettyVersion('arrowsphere/public-api-client') ?? '',
                PHP_VERSION,
                $_ENV['PUBLIC_API_CLIENT_USER_AGENT_TAG'] ?? ''
            )
        );
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
