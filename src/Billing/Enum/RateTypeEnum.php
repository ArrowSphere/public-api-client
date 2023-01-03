<?php

namespace ArrowSphere\PublicApiClient\Billing\Enum;

use ArrowSphere\PublicApiClient\AbstractEnum;

class RateTypeEnum extends AbstractEnum
{
    /**
     * @var string discount index
     */
    public const DISCOUNT = 'discount';

    /**
     * @var string none index
     */
    public const NONE = null;

    /**
     * @var string uplift index
     */
    public const UPLIFT = 'uplift';
}
