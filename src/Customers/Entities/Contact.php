<?php

namespace ArrowSphere\PublicApiClient\Customers\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;

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
     * @var string
     */
    private $phone;

    /**
     * Contact constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->email = $data[self::COLUMN_EMAIL];
        $this->firstName = $data[self::COLUMN_FIRST_NAME];
        $this->lastName = $data[self::COLUMN_LAST_NAME];
        $this->phone = $data[self::COLUMN_PHONE];
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_EMAIL      => $this->email,
            self::COLUMN_FIRST_NAME => $this->firstName,
            self::COLUMN_LAST_NAME  => $this->lastName,
            self::COLUMN_PHONE      => $this->phone,
        ];
    }

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
