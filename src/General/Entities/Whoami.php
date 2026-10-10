<?php

namespace ArrowSphere\PublicApiClient\General\Entities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

/**
 * Class Whoami
 */
class Whoami extends AbstractEntity
{
    public const COLUMN_COMPANY_NAME = 'companyName';

    public const COLUMN_ADDRESS_LINE_1 = 'addressLine1';

    public const COLUMN_ADDRESS_LINE_2 = 'addressLine2';

    public const COLUMN_ZIP = 'zip';

    public const COLUMN_CITY = 'city';

    public const COLUMN_COUNTRY_CODE = 'countryCode';

    public const COLUMN_STATE = 'state';

    public const COLUMN_RECEPTION_PHONE = 'receptionPhone';

    public const COLUMN_WEBSITE_URL = 'websiteUrl';

    public const COLUMN_EMAIL_CONTACT = 'emailContact';

    public const COLUMN_HEADCOUNT = 'headcount';

    public const COLUMN_TAX_NUMBER = 'taxNumber';

    public const COLUMN_REFERENCE = 'reference';

    public const COLUMN_REF = 'ref';

    public const COLUMN_BILLING_ID = 'billingId';

    public const COLUMN_INTERNAL_REFERENCE = 'internalReference';

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_COMPANY_NAME, required: true)]
    protected string $companyName;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_ADDRESS_LINE_1, serializeNull: true)]
    protected ?string $addressLine1 = null;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_ADDRESS_LINE_2, serializeNull: true)]
    protected ?string $addressLine2 = null;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_ZIP, required: true)]
    protected string $zip;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_CITY, required: true)]
    protected string $city;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_COUNTRY_CODE, required: true)]
    protected string $countryCode;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_STATE, required: true)]
    protected string $state;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_RECEPTION_PHONE, required: true)]
    protected string $receptionPhone;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_WEBSITE_URL, required: true)]
    protected string $websiteUrl;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_EMAIL_CONTACT, required: true)]
    protected string $emailContact;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_HEADCOUNT, serializeNull: true)]
    protected ?string $headcount = null;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_TAX_NUMBER, required: true)]
    protected string $taxNumber;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_REFERENCE, required: true)]
    protected string $reference;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_REF, required: true)]
    protected string $ref;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_BILLING_ID, required: true)]
    protected string $billingId;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_INTERNAL_REFERENCE, required: true)]
    protected string $internalReference;

    /**
     * @return string
     */
    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    /**
     * @return string|null
     */
    public function getAddressLine1(): ?string
    {
        return $this->addressLine1;
    }

    /**
     * @return string|null
     */
    public function getAddressLine2(): ?string
    {
        return $this->addressLine2;
    }

    /**
     * @return string
     */
    public function getZip(): string
    {
        return $this->zip;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @return string
     */
    public function getReceptionPhone(): string
    {
        return $this->receptionPhone;
    }

    /**
     * @return string
     */
    public function getWebsiteUrl(): string
    {
        return $this->websiteUrl;
    }

    /**
     * @return string
     */
    public function getEmailContact(): string
    {
        return $this->emailContact;
    }

    /**
     * @return string|null
     */
    public function getHeadcount(): ?string
    {
        return $this->headcount;
    }

    /**
     * @return string
     */
    public function getTaxNumber(): string
    {
        return $this->taxNumber;
    }

    /**
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * @return string
     */
    public function getRef(): string
    {
        return $this->ref;
    }

    /**
     * @return string
     */
    public function getBillingId(): string
    {
        return $this->billingId;
    }

    /**
     * @return string
     */
    public function getInternalReference(): string
    {
        return $this->internalReference;
    }
}
