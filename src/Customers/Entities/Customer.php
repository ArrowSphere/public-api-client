<?php

namespace ArrowSphere\PublicApiClient\Customers\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

/**
 * Class Customer
 */
class Customer extends AbstractEntity
{
    public const COLUMN_ADDRESS_LINE_1 = 'AddressLine1';

    public const COLUMN_ADDRESS_LINE_2 = 'AddressLine2';

    public const COLUMN_BILLING_ID = 'BillingId';

    public const COLUMN_CITY = 'City';

    public const COLUMN_COMPANY_NAME = 'CompanyName';

    public const COLUMN_CONTACT = 'Contact';

    public const COLUMN_COUNTRY_CODE = 'CountryCode';

    public const COLUMN_DETAILS = 'Details';

    public const COLUMN_DELETED_AT = 'DeletedAt';

    public const COLUMN_EMAIL_CONTACT = 'EmailContact';

    public const COLUMN_HEADCOUNT = 'Headcount';

    public const COLUMN_INTERNAL_REFERENCE = 'InternalReference';

    public const COLUMN_RECEPTION_PHONE = 'ReceptionPhone';

    public const COLUMN_REF = 'Ref';

    public const COLUMN_REFERENCE = 'Reference';

    public const COLUMN_STATE = 'State';

    public const COLUMN_TAX_NUMBER = 'TaxNumber';

    public const COLUMN_WEBSITE_URL = 'WebsiteUrl';

    public const COLUMN_ZIP = 'Zip';

    protected const VALIDATION_RULES = [
        self::COLUMN_ADDRESS_LINE_1     => 'required',
        self::COLUMN_ADDRESS_LINE_2     => 'present',
        self::COLUMN_BILLING_ID         => 'present',
        self::COLUMN_CITY               => 'required',
        self::COLUMN_COMPANY_NAME       => 'required',
        self::COLUMN_CONTACT            => 'required|array',
        self::COLUMN_COUNTRY_CODE       => 'required',
        self::COLUMN_DETAILS            => 'present|array',
        self::COLUMN_EMAIL_CONTACT      => 'present',
        self::COLUMN_HEADCOUNT          => 'present',
        self::COLUMN_INTERNAL_REFERENCE => 'present',
        self::COLUMN_RECEPTION_PHONE    => 'present',
        self::COLUMN_REF                => 'present',
        self::COLUMN_STATE              => 'present',
        self::COLUMN_TAX_NUMBER         => 'present',
        self::COLUMN_ZIP                => 'present',
    ];

    /** @var string */
    private $addressLine1;

    /** @var string */
    private $addressLine2;

    /** @var string */
    private $billingId;

    /** @var string */
    private $city;

    /** @var string */
    private $companyName;

    /** @var Contact */
    private $contact;

    /** @var string */
    private $countryCode;

    /** @var CompanyDetails */
    private $details;

    /** @var string|null */
    private $deletedAt;

    /** @var string */
    private $emailContact;

    /** @var int|null */
    private $headcount;

    /** @var string */
    private $internalReference;

    /** @var string */
    private $receptionPhone;

    /** @var string */
    private $ref;

    /** @var string */
    private $reference;

    /** @var string */
    private $state;

    /** @var string */
    private $taxNumber;

    /** @var string|null */
    private $websiteUrl;

    /** @var string */
    private $zip;

    /**
     * Customer constructor.
     *
     * @param array $data
     * @throws EntityValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->addressLine1 = $data[self::COLUMN_ADDRESS_LINE_1];
        $this->addressLine2 = $data[self::COLUMN_ADDRESS_LINE_2];
        $this->billingId = $data[self::COLUMN_BILLING_ID];
        $this->city = $data[self::COLUMN_CITY];
        $this->companyName = $data[self::COLUMN_COMPANY_NAME];
        $this->contact = new Contact($data[self::COLUMN_CONTACT]);
        $this->countryCode = $data[self::COLUMN_COUNTRY_CODE];
        $this->details = new CompanyDetails($data[self::COLUMN_DETAILS]);
        $this->deletedAt = $data[self::COLUMN_DELETED_AT] ?? null;
        $this->emailContact = $data[self::COLUMN_EMAIL_CONTACT];
        $this->headcount = $data[self::COLUMN_HEADCOUNT];
        $this->internalReference = $data[self::COLUMN_INTERNAL_REFERENCE];
        $this->receptionPhone = $data[self::COLUMN_RECEPTION_PHONE];
        $this->ref = $data[self::COLUMN_REF];
        $this->reference = $data[self::COLUMN_REFERENCE] ?? null;
        $this->state = $data[self::COLUMN_STATE];
        $this->taxNumber = $data[self::COLUMN_TAX_NUMBER];
        $this->websiteUrl = $data[self::COLUMN_WEBSITE_URL] ?? null;
        $this->zip = $data[self::COLUMN_ZIP];
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            self::COLUMN_ADDRESS_LINE_1     => $this->addressLine1,
            self::COLUMN_ADDRESS_LINE_2     => $this->addressLine2,
            self::COLUMN_BILLING_ID         => $this->billingId,
            self::COLUMN_CITY               => $this->city,
            self::COLUMN_COMPANY_NAME       => $this->companyName,
            self::COLUMN_CONTACT            => $this->contact->jsonSerialize(),
            self::COLUMN_COUNTRY_CODE       => $this->countryCode,
            self::COLUMN_DETAILS            => $this->details->jsonSerialize(),
            self::COLUMN_DELETED_AT         => $this->deletedAt,
            self::COLUMN_EMAIL_CONTACT      => $this->emailContact,
            self::COLUMN_HEADCOUNT          => $this->headcount,
            self::COLUMN_INTERNAL_REFERENCE => $this->internalReference,
            self::COLUMN_RECEPTION_PHONE    => $this->receptionPhone,
            self::COLUMN_REF                => $this->ref,
            self::COLUMN_REFERENCE          => $this->reference,
            self::COLUMN_STATE              => $this->state,
            self::COLUMN_TAX_NUMBER         => $this->taxNumber,
            self::COLUMN_WEBSITE_URL        => $this->websiteUrl,
            self::COLUMN_ZIP                => $this->zip,
        ];
    }

    /**
     * @return string
     */
    public function getAddressLine1(): string
    {
        return $this->addressLine1;
    }

    /**
     * @return string
     */
    public function getAddressLine2(): string
    {
        return $this->addressLine2;
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
    public function getCity(): string
    {
        return $this->city;
    }

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

    /**
     * @return string
     */
    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    /**
     * @return CompanyDetails
     */
    public function getDetails(): CompanyDetails
    {
        return $this->details;
    }

    /**
     * @return string|null
     */
    public function getDeletedAt(): ?string
    {
        return $this->deletedAt;
    }

    /**
     * @return string
     */
    public function getEmailContact(): string
    {
        return $this->emailContact;
    }

    /**
     * @return int|null
     */
    public function getHeadcount(): ?int
    {
        return $this->headcount;
    }

    /**
     * @return string
     */
    public function getInternalReference(): string
    {
        return $this->internalReference;
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
    public function getRef(): string
    {
        return $this->ref;
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
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @return string
     */
    public function getTaxNumber(): string
    {
        return $this->taxNumber;
    }

    /**
     * @return string|null
     */
    public function getWebsiteUrl(): ?string
    {
        return $this->websiteUrl;
    }

    /**
     * @return string
     */
    public function getZip(): string
    {
        return $this->zip;
    }
}
