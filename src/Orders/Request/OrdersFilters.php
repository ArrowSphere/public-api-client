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

    #[Property()]
    protected ?string $orderBy = null;

    #[Property()]
    protected ?string $sortBy = null;

    #[Property()]
    protected ?string $from = null;

    #[Property()]
    protected ?string $reference = null;

    #[Property()]
    protected ?string $status = null;

    #[Property()]
    protected ?string $program = null;

    #[Property()]
    protected ?string $period = null;

    #[Property()]
    protected ?string $lastUpdate = null;

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
}
