<?php

namespace ArrowSphere\PublicApiClient\Billing\Enum;

use ArrowSphere\PublicApiClient\AbstractEnum;

class StatementStatusEnum extends AbstractEnum
{
    /**
     * @var string Fulfilled index
     */
    public const FULFILLED = 'Fulfilled';

    /**
     * @var string In Progress index
     */
    public const IN_PROGRESS = 'In Progress';

    /**
     * @var string Open index
     */
    public const OPEN = 'Open';
}
