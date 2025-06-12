<?php

namespace ArrowSphere\PublicApiClient\Customers\Request;

use ArrowSphere\PublicApiClient\Customers\Request\SubEntities\CustomerFilters;
use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

class ExportCustomersRequest extends AbstractEntity
{
    public const COLUMN_FILTERS = 'filters';

    #[Property(type: CustomerFilters::class)]
    protected ?CustomerFilters $filters = null;

    /**
     * @param array{
     *     filters: array{
     *      companyName: string,
     *      city: string
     *      }
     * } $data
     *
     * @throws \ArrowSphere\PublicApiClient\Entities\Exception\EntitiesException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);
    }
}
