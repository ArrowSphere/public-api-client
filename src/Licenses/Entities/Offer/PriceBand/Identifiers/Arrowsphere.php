<?php

namespace ArrowSphere\PublicApiClient\Licenses\Entities\Offer\PriceBand\Identifiers;

use ArrowSphere\PublicApiClient\AbstractEntity;

/**
 * Class SaleConstraints
 */
class Arrowsphere extends AbstractEntity
{
    public const COLUMN_SKU = 'sku';

    /**
     * @var string
     */
    private $sku;

    /**
     * Arrowsphere constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->sku = $data[self::COLUMN_SKU];
    }

    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->sku;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_SKU => $this->sku,
        ];
    }
}
