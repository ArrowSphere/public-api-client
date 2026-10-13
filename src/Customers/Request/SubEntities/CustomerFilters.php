<?php

namespace ArrowSphere\PublicApiClient\Customers\Request\SubEntities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;
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
     * @var string|null
     */
    #[Property()]
    protected ?string $billingId;

    /**
     * @var string|null
     */
    #[Property()]
    protected ?string $city;

    /**
     * @var string|null
     */
    #[Property()]
    protected ?string $acronym;

    /**
     * @var string|null
     */
    #[Property()]
    protected ?string $resellerName;

    /**
     * @var string|null
     */
    #[Property()]
    protected ?string $companyName;

    /**
     * @var string|null
     */
    #[Property()]
    protected ?string $country;

    /**
     * @var string|null
     */
    #[Property()]
    protected ?string $internalReference;

    /**
     * @var string|null
     */
    #[Property()]
    protected ?string $companyId;

    /**
     * @var string|null
     */
    #[Property()]
    protected ?string $state;

    /**
     * @var string|null
     */
    #[Property()]
    protected ?string $zip;

    /**
     * @var string|null
     */
    #[Property()]
    protected ?string $creationDate;

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

        /** @var array<string|null> $data */
        $this->resellerName = $data[self::COLUMN_RESELLER_NAME] ?? null;
        $this->acronym = $data[self::COLUMN_ACRONYM] ?? null;
        $this->companyId = $data[self::COLUMN_COMPANY_ID] ?? null;
        $this->billingId = $data[self::COLUMN_BILLING_ID] ?? null;
        $this->city = $data[self::COLUMN_CITY] ?? null;
        $this->companyName = $data[self::COLUMN_COMPANY_NAME] ?? null;
        $this->country = $data[self::COLUMN_COUNTRY_NAME] ?? null;
        $this->internalReference = $data[self::COLUMN_INTERNAL_REFERENCE] ?? null;
        $this->creationDate = $data[self::COLUMN_CREATION_DATE] ?? null;
        $this->state = $data[self::COLUMN_STATE] ?? null;
        $this->zip = $data[self::COLUMN_ZIP] ?? null;
    }

    /**
     * @return string|null
     */
    public function getBillingId(): ?string
    {
        return $this->billingId;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @return string|null
     */
    public function getAcronym(): ?string
    {
        return $this->acronym;
    }

    /**
     * @return string|null
     */
    public function getResellerName(): ?string
    {
        return $this->resellerName;
    }

    /**
     * @return string|null
     */
    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    /**
     * @return string|null
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @return string|null
     */
    public function getInternalReference(): ?string
    {
        return $this->internalReference;
    }

    /**
     * @return string|null
     */
    public function getCompanyId(): ?string
    {
        return $this->companyId;
    }

    /**
     * @return string|null
     */
    public function getState(): ?string
    {
        return $this->state;
    }

    /**
     * @return string|null
     */
    public function getZip(): ?string
    {
        return $this->zip;
    }

    /**
     * @return string|null
     */
    public function getCreationDate(): ?string
    {
        return $this->creationDate;
    }
}
