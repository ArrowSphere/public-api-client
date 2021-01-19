<?php

namespace ArrowSphere\PublicApiClient\Consumption\Enum;

use ArrowSphere\PublicApiClient\AbstractEnum;

abstract class ConstantEnum extends AbstractEnum {
    /** @var string classification index */
    public const CLASSIFICATION = 'classification';

    /** @var string vendor index */
    public const VENDOR = 'vendor';

    /** @var string marketPlace index */
    public const MARKETPLACE = 'marketplace';

    /** @var string subscription index */
    public const LICENSE = 'license';

    /** @var string tax index */
    public const TAG = 'tag';
}
