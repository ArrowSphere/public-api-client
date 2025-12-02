<?php

namespace ArrowSphere\PublicApiClient\Licenses\Entities\License;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

/**
 * Class Credentials
 */
class Credentials extends AbstractEntity
{
    public const COLUMN_USERNAME = 'username';

    public const COLUMN_PASSWORD_RESET_URL = 'passwordResetUrl';

    public const COLUMN_URL = 'url';

    protected const VALIDATION_RULES = [
        self::COLUMN_USERNAME           => 'nullable|string',
        self::COLUMN_PASSWORD_RESET_URL => 'nullable|string',
        self::COLUMN_URL                => 'nullable|string',
    ];

    /**
     * @var string|null
     */
    private $username;

    /**
     * @var string|null
     */
    private $passwordResetUrl;

    /**
     * @var string|null
     */
    private $url;

    /**
     * Credentials constructor.
     *
     * @param array $data
     *
     * @throws EntityValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->username = $data[self::COLUMN_USERNAME] ?? null;
        $this->passwordResetUrl = $data[self::COLUMN_PASSWORD_RESET_URL] ?? null;
        $this->url = $data[self::COLUMN_URL] ?? null;
    }

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

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_USERNAME           => $this->username,
            self::COLUMN_PASSWORD_RESET_URL => $this->passwordResetUrl,
            self::COLUMN_URL                => $this->url,
        ];
    }
}
