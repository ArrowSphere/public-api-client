<?php

namespace ArrowSphere\PublicApiClient\Orders\Entities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

class Contact extends AbstractEntity
{
    public const COLUMN_EMAIL = 'email';

    public const COLUMN_FIRSTNAME = 'firstName';

    public const COLUMN_LASTNAME = 'lastName';

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_EMAIL, required: true)]
    protected string $email;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_FIRSTNAME, required: true)]
    protected string $firstName;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_LASTNAME, required: true)]
    protected string $lastName;

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }
}
