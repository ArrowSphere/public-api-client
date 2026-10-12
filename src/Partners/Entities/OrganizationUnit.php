<?php

namespace ArrowSphere\PublicApiClient\Partners\Entities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Exception\EntitiesException;
use ArrowSphere\PublicApiClient\Entities\Property;

/**
 * @deprecated This entity is obsolete. Please use OrganizationUnitClient.
 */
class OrganizationUnit extends AbstractEntity
{
    public const COLUMN_REFERENCE = 'organizationUnitRef';
    public const COLUMN_COMPANY_REFERENCE = 'companyRef';
    public const COLUMN_NAME = 'name';
    public const COLUMN_COUNT_USERS = 'countUsers';
    public const COLUMN_COUNT_CUSTOMERS = 'countCustomers';

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_REFERENCE)]
    protected string $organizationUnitRef = '';

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_COMPANY_REFERENCE)]
    protected string $companyRef = '';

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_NAME)]
    protected string $name = '';

    /**
     * @var int Not serialized, hydrated by the constructor
     */
    protected int $countUsers = 0;

    /**
     * @var int Not serialized, hydrated by the constructor
     */
    protected int $countCustomers = 0;

    /**
     * OrganizationUnit constructor.
     *
     * @param array $data
     *
     * @throws EntitiesException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->countUsers = (int) ($data[self::COLUMN_COUNT_USERS] ?? 0);
        $this->countCustomers = (int) ($data[self::COLUMN_COUNT_CUSTOMERS] ?? 0);
    }

    /**
     * @return string
     */
    public function getOrganizationUnitRef(): string
    {
        return $this->organizationUnitRef;
    }

    /**
     * @return string
     */
    public function getCompanyRef(): string
    {
        return $this->companyRef;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getCountUsers(): int
    {
        return $this->countUsers;
    }

    /**
     * @return int
     */
    public function getCountCustomers(): int
    {
        return $this->countCustomers;
    }
}
