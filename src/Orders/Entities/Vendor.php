<?php

namespace ArrowSphere\PublicApiClient\Orders\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;

class Vendor extends AbstractEntity
{
    public const COLUMN_SKU = 'sku';

    /**
     * @var string Vendor SKU
     */
    private string $sku;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->sku = $data[self::COLUMN_SKU];
    }

    public function jsonSerialize(): array
    {
        return [self::COLUMN_SKU => $this->sku];
    }

    public function getSku(): string
    {
        return $this->sku;
    }
}
