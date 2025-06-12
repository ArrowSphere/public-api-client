<?php

namespace ArrowSphere\PublicApiClient\Customers\Request\SubEntities;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

/**
 * Class Customer
 */
class CustomerFilters extends AbstractEntity
{
    public const COLUMN_COMPANY_ID = 'CompanyId';

    public const COLUMN_RESELLER_NAME = 'Partner';

    public const COLUMN_COMPANY_NAME = 'Customer Company';

    public const COLUMN_INTERNAL_REFERENCE = 'Internal Reference';

    public const COLUMN_BILLING_ID = 'Billing ID';

    public const COLUMN_ACRONYM = 'Acronym';

    public const COLUMN_COUNTRY_NAME = 'Country';

    public const COLUMN_CITY = 'City';

    public const COLUMN_STATE = 'State';

    public const COLUMN_CREATION_DATE = 'Since';

    public const COLUMN_ZIP = 'Zip';

    protected const VALIDATION_RULES = [];

    /**
     * @var string
     */
    private $billingId;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $acronym;

    /**
     * @var string
     */
    private $resellerName;

    /**
     * @var string
     */
    private $companyName;

    /**
     * @var string
     */
    private $country;

    /**
     * @var string
     */
    private $internalReference;

    /**
     * @var string
     */
    private $companyId;

    /**
     * @var string
     */
    private $state;

    /**
     * @var string
     */
    private $zip;

    /**
     * @var string
     */
    private $creationDate;

    /**
     * Customer constructor.
     *
     * @param array $data
     *
     * @throws EntityValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->resellerName = $data[self::COLUMN_RESELLER_NAME];
        $this->acronym = $data[self::COLUMN_ACRONYM];
        $this->companyId = $data[self::COLUMN_COMPANY_ID];
        $this->billingId = $data[self::COLUMN_BILLING_ID];
        $this->city = $data[self::COLUMN_CITY];
        $this->companyName = $data[self::COLUMN_COMPANY_NAME];
        $this->country = $data[self::COLUMN_COUNTRY_NAME];
        $this->internalReference = $data[self::COLUMN_INTERNAL_REFERENCE];
        $this->creationDate = $data[self::COLUMN_CREATION_DATE] ?? null;
        $this->state = $data[self::COLUMN_STATE];
        $this->zip = $data[self::COLUMN_ZIP];
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_RESELLER_NAME      => $this->resellerName,
            self::COLUMN_ACRONYM            => $this->acronym,
            self::COLUMN_COMPANY_ID         => $this->companyId,
            self::COLUMN_BILLING_ID         => $this->billingId,
            self::COLUMN_CITY               => $this->city,
            self::COLUMN_COMPANY_NAME       => $this->companyName,
            self::COLUMN_COUNTRY_NAME       => $this->country,
            self::COLUMN_INTERNAL_REFERENCE => $this->internalReference,
            self::COLUMN_STATE              => $this->state,
            self::COLUMN_ZIP                => $this->zip,
            self::COLUMN_CREATION_DATE      => $this->creationDate,
        ];
    }

    /**
     * @return string|null
     */
    public function getResellerName(): string|null
    {
        return $this->resellerName;
    }

    /**
     * @return string|null
     */
    public function getAcronym(): string|null
    {
        return $this->acronym;
    }

    /**
     * @return string|null
     */
    public function getCompanyId(): string|null
    {
        return $this->companyId;
    }

    /**
     * @return string|null
     */
    public function getBillingId(): string|null
    {
        return $this->billingId;
    }

    /**
     * @return string|null
     */
    public function getCity(): string|null
    {
        return $this->city;
    }

    /**
     * @return string|null
     */
    public function getCompanyName(): string|null
    {
        return $this->companyName;
    }

    /**
     * @return string|null
     */
    public function getCountry(): string|null
    {
        return $this->country;
    }

    /**
     * @return string|null
     */
    public function getInternalReference(): string|null
    {
        return $this->internalReference;
    }

    /**
     * @return string|null
     */
    public function getState(): string|null
    {
        return $this->state;
    }

    /**
     * @return string|null
     */
    public function getZip(): string|null
    {
        return $this->zip;
    }

    /**
     * @return string|null
     */
    public function getCreationDate(): string|null
    {
        return $this->creationDate;
    }
}
