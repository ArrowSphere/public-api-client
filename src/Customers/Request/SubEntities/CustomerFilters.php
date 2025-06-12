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

    #[Property()]
    protected ?string $billingId;

    #[Property()]
    protected ?string $city;

    #[Property()]
    protected ?string $acronym;

    #[Property()]
    protected ?string $resellerName;

    #[Property()]
    protected ?string $companyName;

    #[Property()]
    protected ?string $country;

    #[Property()]
    protected ?string $internalReference;

    #[Property()]
    protected ?string $companyId;

    #[Property()]
    protected ?string $state;

    #[Property()]
    protected ?string $zip;

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
}
