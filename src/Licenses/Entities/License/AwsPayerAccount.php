<?php

namespace ArrowSphere\PublicApiClient\Licenses\Entities\License;

use ArrowSphere\PublicApiClient\AbstractEntity;

class AwsPayerAccount extends AbstractEntity
{
    public const COLUMN_TYPE = 'type';
    public const COLUMN_FRIENDLY_NAME = 'friendlyName';
    public const COLUMN_LICENSE_REF = 'licenseRef';

    protected const VALIDATION_RULES = [
        self::COLUMN_TYPE => 'required|string',
        self::COLUMN_FRIENDLY_NAME => 'required|string',
        self::COLUMN_LICENSE_REF => 'required|string',
    ];

    protected string $type;

    protected string $friendlyName;
    protected string $licenseRef;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->type = $data[self::COLUMN_TYPE];
        $this->friendlyName = $data[self::COLUMN_FRIENDLY_NAME];
        $this->licenseRef = $data[self::COLUMN_LICENSE_REF];
    }

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

    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_TYPE => $this->type,
            self::COLUMN_FRIENDLY_NAME => $this->friendlyName,
            self::COLUMN_LICENSE_REF => $this->licenseRef,
        ];
    }
}
