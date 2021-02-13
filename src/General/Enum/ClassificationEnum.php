<?php

namespace ArrowSphere\PublicApiClient\General\Enum;

use ArrowSphere\PublicApiClient\AbstractEnum;

abstract class ClassificationEnum extends AbstractEnum
{
    /**
     * @var string
     */
    public const IAAS = 'IAAS';

    /**
     * @var string
     */
    public const SAAS = 'SAAS';

    /**
     * @var string
     */
    public const FTSL = 'FTSL';

    /**
     * @var string
     */
    public const PSW = 'PSW';
}
