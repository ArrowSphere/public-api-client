<?php

namespace ArrowSphere\PublicApiClient\Orders\Entities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

class Partner extends AbstractEntity
{
    public const COLUMN_COMPANY_NAME = 'companyName';

    public const COLUMN_CONTACT = 'contact';

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_COMPANY_NAME, required: true)]
    protected string $companyName;

    /**
     * @var Contact
     */
    #[Property(name: self::COLUMN_CONTACT, type: Contact::class, required: true)]
    protected Contact $contact;

    /**
     * @return string
     */
    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    /**
     * @return Contact
     */
    public function getContact(): Contact
    {
        return $this->contact;
    }
}
