<?php

namespace ArrowSphere\PublicApiClient\Customers\Entities\Invitation;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

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
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @param array $data
     *
     * @throws EntityValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->username = $data[self::COLUMN_USERNAME];
        $this->email = $data[self::COLUMN_EMAIL];
        $this->firstName = $data[self::COLUMN_FIRST_NAME];
        $this->lastName = $data[self::COLUMN_LAST_NAME];
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
    public function getUsername(): string
    {
        return $this->username;
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

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_USERNAME => $this->username,
            self::COLUMN_EMAIL => $this->email,
            self::COLUMN_FIRST_NAME => $this->firstName,
            self::COLUMN_LAST_NAME => $this->lastName,
        ];
    }
}
