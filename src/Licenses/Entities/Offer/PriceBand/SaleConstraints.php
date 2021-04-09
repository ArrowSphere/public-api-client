<?php

namespace ArrowSphere\PublicApiClient\Licenses\Entities\Offer\PriceBand;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

/**
 * Class SaleConstraints
 */
class SaleConstraints extends AbstractEntity
{
    public const COLUMN_MIN_QUANTITY = 'minQuantity';

    public const COLUMN_MAX_QUANTITY = 'maxQuantity';

    /**
     * @var float|null
     */
    private $minQuantity;

    /**
     * @var float|null
     */
    private $maxQuantity;

    /**
     * SaleConstraints constructor.
     *
     * @param array $data
     *
     * @throws EntityValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->minQuantity = $data[self::COLUMN_MIN_QUANTITY];
        $this->maxQuantity = $data[self::COLUMN_MAX_QUANTITY];
    }

    /**
     * @return float|null
     */
    public function getMinQuantity(): ?float
    {
        return $this->minQuantity;
    }

    /**
     * @return float|null
     */
    public function getMaxQuantity(): ?float
    {
        return $this->maxQuantity;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_MIN_QUANTITY => $this->getMinQuantity(),
            self::COLUMN_MAX_QUANTITY => $this->getMaxQuantity(),
        ];
    }
}
