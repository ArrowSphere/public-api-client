<?php

namespace ArrowSphere\PublicApiClient\Orders\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;

class Identifiers extends AbstractEntity
{
    public const COLUMN_VENDOR = 'vendor';

    /**
     * @var Vendor
     */
    private Vendor $vendor;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->vendor = new Vendor($data[self::COLUMN_VENDOR]);
    }

    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_VENDOR => $this->vendor,
        ];
    }

    public function getVendor(): Vendor
    {
        return $this->vendor;
    }
}
