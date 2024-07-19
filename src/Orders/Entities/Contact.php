<?php

namespace ArrowSphere\PublicApiClient\Orders\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;

class Contact extends AbstractEntity
{
    public const COLUMN_EMAIL = 'email';
    public const COLUMN_FIRSTNAME = 'firstName';
    public const COLUMN_LASTNAME = 'lastName';

    /**
     * @var string The contact email
     */
    private string $email;

    /**
     * @var string The contact first name
     */
    private string $firstName;

    /**
     * @var string The contact last name
     */
    private string $lastName;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->email = $data[self::COLUMN_EMAIL];
        $this->firstName = $data[self::COLUMN_FIRSTNAME];
        $this->lastName = $data[self::COLUMN_LASTNAME];
    }

    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_EMAIL     => $this->email,
            self::COLUMN_FIRSTNAME => $this->firstName,
            self::COLUMN_LASTNAME  => $this->lastName,
        ];
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }
}
