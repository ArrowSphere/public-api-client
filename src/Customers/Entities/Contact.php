<?php

namespace ArrowSphere\PublicApiClient\Customers\Entities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

/**
 * Class Contact
 */
class Contact extends AbstractEntity
{
    public const COLUMN_EMAIL = 'Email';

    public const COLUMN_FIRST_NAME = 'FirstName';

    public const COLUMN_LAST_NAME = 'LastName';

    public const COLUMN_PHONE = 'Phone';

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
     * @var string
     */
    #[Property(name: self::COLUMN_PHONE, required: true)]
    protected string $phone;

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

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }
}
