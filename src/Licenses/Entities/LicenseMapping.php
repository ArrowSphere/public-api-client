<?php

namespace ArrowSphere\PublicApiClient\Licenses\Entities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

/**
 * Class LicenseMapping
 *
 * The mapping of the license dynamic attributes, indexed by field path (e.g. license.attributes.renewalPolicy),
 * with the type of the field as value (see LicenseMappingTypeEnum).
 */
class LicenseMapping extends AbstractEntity
{
    /**
     * @var string
     */
    public const COLUMN_LICENSE_MAPPING = 'licenseMapping';

    /**
     * @var array<string, string>
     */
    #[Property(type: 'array')]
    protected array $licenseMapping = [];

    /**
     * @param array $data
     *
     * @throws \ArrowSphere\PublicApiClient\Entities\Exception\EntitiesException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);
    }

    /**
     * Returns the mapping of the license dynamic attributes, indexed by field path, with the field type as value.
     *
     * @return array<string, string>
     */
    public function getLicenseMapping(): array
    {
        return $this->licenseMapping;
    }

    /**
     * Returns the type of the given field, or null if the field is not part of the mapping.
     *
     * @param string $field The field path (e.g. license.attributes.renewalPolicy)
     *
     * @return string|null
     */
    public function getType(string $field): ?string
    {
        return $this->licenseMapping[$field] ?? null;
    }
}
