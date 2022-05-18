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
     * @var string Needs Validation index
     */
    public const NEEDS_VALIDATION = 'Needs Validation';

    /**
     * @var string Open index
     */
    public const OPEN = 'Open';

    /**
     * @var string Rejected index
     */
    public const REJECTED = 'Rejected';
}
