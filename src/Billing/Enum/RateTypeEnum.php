<?php

namespace ArrowSphere\PublicApiClient\Billing\Enum;

use ArrowSphere\PublicApiClient\AbstractEnum;

class RateTypeEnum extends AbstractEnum
{
    public const DISCOUNT = 'discount';
    public const NONE = null;
    public const UPLIFT = 'uplift';
}
