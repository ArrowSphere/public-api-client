<?php

namespace ArrowSphere\PublicApiClient\Partners\Entities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Exception\EntitiesException;
use ArrowSphere\PublicApiClient\Entities\Pagination;
use ArrowSphere\PublicApiClient\Entities\Property;

/**
 * @deprecated This entity is obsolete. Please use OrganizationUnitClient.
 */
class OrganizationUnitsResponse extends AbstractEntity
{
    public const ORGANIZATION_UNITS = 'organizationUnits';
    public const PAGINATION = 'pagination';

    /**
     * @var OrganizationUnit[]
     */
    #[Property(name: self::ORGANIZATION_UNITS, type: OrganizationUnit::class, isArray: true)]
    protected array $organizationUnits = [];

    /**
     * @var Pagination
     */
    #[Property(name: self::PAGINATION, type: Pagination::class)]
    protected Pagination $pagination;

    /**
     * OrganizationUnitsResponse constructor.
     *
     * @param array $data
     *
     * @throws EntitiesException
     */
    public function __construct(array $data)
    {
        // The organization units are the data of the response, the pagination comes from its root
        parent::__construct([
            self::ORGANIZATION_UNITS => $data['data'] ?? [],
            self::PAGINATION         => $data[self::PAGINATION] ?? [],
        ]);

        // A missing pagination gets an empty one, as an empty array would be considered as missing
        if (! isset($this->pagination)) {
            $this->pagination = new Pagination([]);
        }
    }

    /**
     * @return OrganizationUnit[]
     */
    public function getOrganizationUnits(): array
    {
        return $this->organizationUnits;
    }

    /**
     * @return Pagination
     */
    public function getPagination(): Pagination
    {
        return $this->pagination;
    }
}
