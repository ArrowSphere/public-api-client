<?php

namespace ArrowSphere\PublicApiClient\Customers\Entities\Invitation;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

/**
 * Class Contact
 */
class Contact extends AbstractEntity
{
    public const COLUMN_USERNAME = 'username';

    public const COLUMN_EMAIL = 'email';

    public const COLUMN_FIRST_NAME = 'firstName';

    public const COLUMN_LAST_NAME = 'lastName';

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_USERNAME, serializeNull: true)]
    protected ?string $username = null;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_EMAIL, required: true)]
    protected string $email;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_FIRST_NAME, required: true)]
    protected string $firstName;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_LAST_NAME, required: true)]
    protected string $lastName;

    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string $username
     *
     * @return static
     */
    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return static
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     *
     * @return static
     */
    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     *
     * @return static
     */
    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }
}
