<?php

namespace ArrowSphere\PublicApiClient\Licenses\Enum;

use ArrowSphere\PublicApiClient\AbstractEnum;

/**
 * Class LicenseMappingTypeEnum
 *
 * The known types of the license dynamic attributes, as returned by LicensesClient::getLicenseMapping().
 * Please note that the API may return other OpenSearch types not listed here.
 */
class LicenseMappingTypeEnum extends AbstractEnum
{
    /**
     * @var string
     */
    public const TEXT = 'text';

    /**
     * @var string
     */
    public const NUMBER = 'number';

    /**
     * @var string
     */
    public const BOOLEAN = 'boolean';

    /**
     * @var string
     */
    public const DATE = 'date';
}
