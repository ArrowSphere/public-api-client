<?php

namespace ArrowSphere\PublicApiClient\Billing\Enum;

use ArrowSphere\PublicApiClient\AbstractEnum;

class FormatDateEnum extends AbstractEnum
{
    /**
     * @var string FORMAT_MACHINE index
     */
    public const FORMAT_MACHINE = 'DD-MM-YYYY';

    /**
     * @var string FORMAT_FR index
     */
    public const FORMAT_FR = 'DD/MM/YYYY';

    /**
     * @var string FORMAT_USA index
     */
    public const FORMAT_USA = 'MM/DD/YYYY';
}
