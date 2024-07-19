<?php

namespace ArrowSphere\PublicApiClient\Orders\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;

class Partner extends AbstractEntity
{
    public const COLUMN_COMPANY_NAME = 'companyName';
    public const COLUMN_CONTACT = 'contact';

    /**
     * @var string The company name of the partner
     */
    private string $companyName;

    /**
     * @var Contact
     */
    private Contact $contact;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->companyName = $data[self::COLUMN_COMPANY_NAME];
        $this->contact = new Contact($data[self::COLUMN_CONTACT]);
    }

    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_COMPANY_NAME => $this->companyName,
            self::COLUMN_CONTACT      => $this->contact->jsonSerialize(),
        ];
    }

    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    public function getContact(): Contact
    {
        return $this->contact;
    }
}
