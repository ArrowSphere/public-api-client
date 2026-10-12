<?php

namespace ArrowSphere\PublicApiClient\Licenses\Entities\License;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

/**
 * Class Credentials
 */
class Credentials extends AbstractEntity
{
    public const COLUMN_USERNAME = 'username';

    public const COLUMN_PASSWORD_RESET_URL = 'passwordResetUrl';

    public const COLUMN_URL = 'url';

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_USERNAME, serializeNull: true)]
    protected ?string $username = null;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_PASSWORD_RESET_URL, serializeNull: true)]
    protected ?string $passwordResetUrl = null;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_URL, serializeNull: true)]
    protected ?string $url = null;

    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @return string|null
     */
    public function getPasswordResetUrl(): ?string
    {
        return $this->passwordResetUrl;
    }

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }
}
