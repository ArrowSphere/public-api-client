<?php

namespace ArrowSphere\PublicApiClient\Licenses\Entities\License;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

class AwsPayerAccount extends AbstractEntity
{
    public const COLUMN_TYPE = 'type';
    public const COLUMN_FRIENDLY_NAME = 'friendlyName';
    public const COLUMN_LICENSE_REF = 'licenseRef';

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_TYPE, required: true)]
    protected string $type;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_FRIENDLY_NAME, required: true)]
    protected string $friendlyName;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_LICENSE_REF, required: true)]
    protected string $licenseRef;

    public function getType(): string
    {
        return $this->type;
    }

    public function getFriendlyName(): string
    {
        return $this->friendlyName;
    }

    public function getLicenseRef(): string
    {
        return $this->licenseRef;
    }
}
