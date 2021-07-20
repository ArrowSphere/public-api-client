<?php

namespace ArrowSphere\PublicApiClient\Billing\Enum;

use ArrowSphere\PublicApiClient\AbstractEnum;

class TierEnum extends AbstractEnum
{
    /**
     * @var int Reseller index
     */
    public const RESELLER = 2;

    /**
     * @var int End Customer index
     */
    public const END_CUSTOMER = 3;
}
