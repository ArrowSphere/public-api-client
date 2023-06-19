<?php

namespace ArrowSphere\PublicApiClient\Partners\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Pagination;

class OrganizationUnitsResponse extends AbstractEntity
{
    public const ORGANIZATION_UNITS = 'organizationUnits';
    public const PAGINATION = 'pagination';

    /**
     * @var OrganizationUnit[]
     */
    private $organizationUnits;

    /**
     * @var Pagination
     */
    private $pagination;

    public function __construct(array $data)
    {
        parent::__construct($data['data']);

        $this->organizationUnits = array_map(
            static function (array $organizationUnit) {
                return new OrganizationUnit($organizationUnit);
            },
            $data['data'] ?? []
        );
        $this->pagination = new Pagination($data[self::PAGINATION] ?? []);
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            self::ORGANIZATION_UNITS => $this->organizationUnits,
            self::PAGINATION => $this->pagination->jsonSerialize(),
        ];
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
