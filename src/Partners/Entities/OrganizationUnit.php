<?php

namespace ArrowSphere\PublicApiClient\Partners\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

/**
 * Class OrganizationUnit
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
    private $organizationUnitRef;

    /**
     * @var string
     */
    private $companyRef;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $countUsers;

    /**
     * @var int
     */
    private $countCustomers;

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

        $this->organizationUnitRef = $data[self::COLUMN_REFERENCE] ?? '';
        $this->companyRef = $data[self::COLUMN_COMPANY_REFERENCE] ?? '';
        $this->name = $data[self::COLUMN_NAME] ?? '';
        $this->countUsers = $data[self::COLUMN_COUNT_USERS] ?? 0;
        $this->countCustomers = $data[self::COLUMN_COUNT_CUSTOMERS] ?? 0;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_REFERENCE  => $this->organizationUnitRef,
            self::COLUMN_COMPANY_REFERENCE => $this->companyRef,
            self::COLUMN_NAME => $this->name,
        ];
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
