<?php

namespace ArrowSphere\PublicApiClient\Orders\Request;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

class OrdersFilters extends AbstractEntity
{
    public const COLUMN_ORDER_BY = 'orderBy';
    public const COLUMN_SORT_BY = 'sortBy';
    public const COLUMN_FROM = 'from';
    public const COLUMN_REFERENCE = 'reference';
    public const COLUMN_STATUS = 'status';
    public const COLUMN_PROGRAM = 'program';
    public const COLUMN_PERIOD = 'period';
    public const COLUMN_LAST_UPDATE = 'lastUpdate';
    public const COLUMN_ORGANIZATION_UNIT_REF = 'organizationUnitRef';

    /**
     * @var string|null
     */
    #[Property()]
    protected ?string $orderBy = null;

    /**
     * @var string|null
     */
    #[Property()]
    protected ?string $sortBy = null;

    /**
     * @var string|null
     */
    #[Property()]
    protected ?string $from = null;

    /**
     * @var string|null
     */
    #[Property()]
    protected ?string $reference = null;

    /**
     * @var string|null
     */
    #[Property()]
    protected ?string $status = null;

    /**
     * @var string|null
     */
    #[Property()]
    protected ?string $program = null;

    /**
     * @var string|null
     */
    #[Property()]
    protected ?string $period = null;

    /**
     * @var string|null
     */
    #[Property()]
    protected ?string $lastUpdate = null;

    /**
     * @var string|null
     */
    #[Property()]
    protected ?string $organizationUnitRef = null;

    /**
     * @param array{
     *     orderBy?: string,
     *     sortBy?: string,
     *     from?: string,
     *     reference?: string,
     *     status?: string,
     *     program?: string,
     *     period?: string,
     *     lastUpdate?: string,
     *     organizationUnitRef?: string
     * } $data
     *
     * @throws \ArrowSphere\PublicApiClient\Entities\Exception\EntitiesException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);
    }

    /**
     * @return string|null
     */
    public function getOrderBy(): ?string
    {
        return $this->orderBy;
    }

    /**
     * @return string|null
     */
    public function getSortBy(): ?string
    {
        return $this->sortBy;
    }

    /**
     * @return string|null
     */
    public function getFrom(): ?string
    {
        return $this->from;
    }

    /**
     * @return string|null
     */
    public function getReference(): ?string
    {
        return $this->reference;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @return string|null
     */
    public function getProgram(): ?string
    {
        return $this->program;
    }

    /**
     * @return string|null
     */
    public function getPeriod(): ?string
    {
        return $this->period;
    }

    /**
     * @return string|null
     */
    public function getLastUpdate(): ?string
    {
        return $this->lastUpdate;
    }

    /**
     * @return string|null
     */
    public function getOrganizationUnitRef(): ?string
    {
        return $this->organizationUnitRef;
    }
}
