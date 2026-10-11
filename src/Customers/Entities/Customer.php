<?php

namespace ArrowSphere\PublicApiClient\Customers\Entities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Exception\EntitiesException;
use ArrowSphere\PublicApiClient\Entities\Property;
use ArrowSphere\PublicApiClient\Partners\Entities\OrganizationUnit;

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

    public const COLUMN_ORGANIZATION_UNIT = 'OrganizationUnit';

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_ADDRESS_LINE_1)]
    protected string $addressLine1 = '';

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_ADDRESS_LINE_2)]
    protected string $addressLine2 = '';

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_BILLING_ID)]
    protected string $billingId = '';

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_CITY, required: true)]
    protected string $city;

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
     * @var string
     */
    #[Property(name: self::COLUMN_COUNTRY_CODE, required: true)]
    protected string $countryCode;

    /**
     * @var CompanyDetails
     */
    #[Property(name: self::COLUMN_DETAILS, type: CompanyDetails::class, required: true)]
    protected CompanyDetails $details;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_DELETED_AT, serializeNull: true)]
    protected ?string $deletedAt = null;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_EMAIL_CONTACT, required: true)]
    protected string $emailContact;

    /**
     * @var int|null
     */
    #[Property(name: self::COLUMN_HEADCOUNT, type: 'int', serializeNull: true)]
    protected ?int $headcount = null;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_INTERNAL_REFERENCE, required: true)]
    protected string $internalReference;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_RECEPTION_PHONE, required: true)]
    protected string $receptionPhone;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_REF, required: true)]
    protected string $ref;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_REFERENCE, serializeNull: true)]
    protected ?string $reference = null;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_STATE, required: true)]
    protected string $state;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_TAX_NUMBER, required: true)]
    protected string $taxNumber;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_WEBSITE_URL, serializeNull: true)]
    protected ?string $websiteUrl = null;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_ZIP, required: true)]
    protected string $zip;

    /**
     * @var OrganizationUnit|null
     */
    #[Property(name: self::COLUMN_ORGANIZATION_UNIT, type: OrganizationUnit::class, serializeNull: true)]
    protected ?OrganizationUnit $organizationUnit = null;

    /**
     * Customer constructor.
     *
     * @param array $data
     *
     * @throws EntitiesException
     */
    public function __construct(array $data)
    {
        // A customer without details gets an empty object from the API, which would be considered as missing
        if (empty($data[self::COLUMN_DETAILS])) {
            $data[self::COLUMN_DETAILS] = new CompanyDetails([]);
        }

        parent::__construct($data);
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
     * @return string|null
     */
    public function getReference(): ?string
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

    /**
     * @return OrganizationUnit|null
     */
    public function getOrganizationUnit(): ?OrganizationUnit
    {
        return $this->organizationUnit;
    }
}
