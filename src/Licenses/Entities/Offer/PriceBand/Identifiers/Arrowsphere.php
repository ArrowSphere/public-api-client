<?php

namespace ArrowSphere\PublicApiClient\Licenses\Entities\Offer\PriceBand\Identifiers;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

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

    protected const VALIDATION_RULES = [
        self::COLUMN_SKU => 'present|string'
    ];

    /**
     * Arrowsphere constructor.
     *
     * @param array $data
     *
     * @throws EntityValidationException
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
