<?php

namespace ArrowSphere\PublicApiClient\Billing\Enum;

use ArrowSphere\PublicApiClient\AbstractEnum;

class BillingPeriodicityEnum extends AbstractEnum
{
    /**
     * @var string Monthly index
     */
    public const MONTHLY = 'Monthly';

    /**
     * @var string Yearly index
     */
    public const YEARLY = 'Yearly';
}
