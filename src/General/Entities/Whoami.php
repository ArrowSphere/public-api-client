<?php

namespace ArrowSphere\PublicApiClient\General\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

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

    protected const VALIDATION_RULES = [
        self::COLUMN_COMPANY_NAME       => 'required',
        self::COLUMN_ADDRESS_LINE_1     => 'present',
        self::COLUMN_ADDRESS_LINE_2     => 'present',
        self::COLUMN_ZIP                => 'present',
        self::COLUMN_CITY               => 'present',
        self::COLUMN_COUNTRY_CODE       => 'required',
        self::COLUMN_STATE              => 'present',
        self::COLUMN_RECEPTION_PHONE    => 'present',
        self::COLUMN_WEBSITE_URL        => 'present',
        self::COLUMN_EMAIL_CONTACT      => 'present',
        self::COLUMN_HEADCOUNT          => 'present',
        self::COLUMN_TAX_NUMBER         => 'present',
        self::COLUMN_REFERENCE          => 'present',
        self::COLUMN_REF                => 'present',
        self::COLUMN_BILLING_ID         => 'present',
        self::COLUMN_INTERNAL_REFERENCE => 'present',
    ];

    /**
     * @var string
     */
    private $companyName;

    /**
     * @var string
     */
    private $addressLine1;

    /**
     * @var string
     */
    private $addressLine2;

    /**
     * @var string
     */
    private $zip;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $countryCode;

    /**
     * @var string
     */
    private $state;

    /**
     * @var string
     */
    private $receptionPhone;

    /**
     * @var string
     */
    private $websiteUrl;

    /**
     * @var string
     */
    private $emailContact;

    /**
     * @var string|null
     */
    private $headcount;

    /**
     * @var string
     */
    private $taxNumber;

    /**
     * @var string
     */
    private $reference;

    /**
     * @var string
     */
    private $ref;

    /**
     * @var string
     */
    private $billingId;

    /**
     * @var string
     */
    private $internalReference;

    /**
     * Whoami constructor.
     *
     * @param array $data
     *
     * @throws EntityValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->companyName = $data[self::COLUMN_COMPANY_NAME];
        $this->addressLine1 = $data[self::COLUMN_ADDRESS_LINE_1];
        $this->addressLine2 = $data[self::COLUMN_ADDRESS_LINE_2];
        $this->zip = $data[self::COLUMN_ZIP];
        $this->city = $data[self::COLUMN_CITY];
        $this->countryCode = $data[self::COLUMN_COUNTRY_CODE];
        $this->state = $data[self::COLUMN_STATE];
        $this->receptionPhone = $data[self::COLUMN_RECEPTION_PHONE];
        $this->websiteUrl = $data[self::COLUMN_WEBSITE_URL];
        $this->emailContact = $data[self::COLUMN_EMAIL_CONTACT];
        $this->headcount = $data[self::COLUMN_HEADCOUNT];
        $this->taxNumber = $data[self::COLUMN_TAX_NUMBER];
        $this->reference = $data[self::COLUMN_REFERENCE];
        $this->ref = $data[self::COLUMN_REF];
        $this->billingId = $data[self::COLUMN_BILLING_ID];
        $this->internalReference = $data[self::COLUMN_INTERNAL_REFERENCE];
    }

    /**
     * @return string
     */
    public function getCompanyName(): string
    {
        return $this->companyName;
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

    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_COMPANY_NAME       => $this->getCompanyName(),
            self::COLUMN_ADDRESS_LINE_1     => $this->getAddressLine1(),
            self::COLUMN_ADDRESS_LINE_2     => $this->getAddressLine2(),
            self::COLUMN_ZIP                => $this->getZip(),
            self::COLUMN_CITY               => $this->getCity(),
            self::COLUMN_COUNTRY_CODE       => $this->getCountryCode(),
            self::COLUMN_STATE              => $this->getState(),
            self::COLUMN_RECEPTION_PHONE    => $this->getReceptionPhone(),
            self::COLUMN_WEBSITE_URL        => $this->getWebsiteUrl(),
            self::COLUMN_EMAIL_CONTACT      => $this->getEmailContact(),
            self::COLUMN_HEADCOUNT          => $this->getHeadcount(),
            self::COLUMN_TAX_NUMBER         => $this->getTaxNumber(),
            self::COLUMN_REFERENCE          => $this->getReference(),
            self::COLUMN_REF                => $this->getRef(),
            self::COLUMN_BILLING_ID         => $this->getBillingId(),
            self::COLUMN_INTERNAL_REFERENCE => $this->getInternalReference(),
        ];
    }
}
