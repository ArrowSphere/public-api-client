<?php

namespace ArrowSphere\PublicApiClient\Quotes\Request\SubEntities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

class Item extends AbstractEntity
{
    public const COLUMN_ARROW_SPHERE_PRICE_BAND_SKU = 'arrowSpherePriceBandSku';
    public const COLUMN_QUANTITY = 'quantity';
    public const COLUMN_PRICES = 'prices';
    public const COLUMN_COTERMINOSITY_DATE = 'coterminosityDate';

    /**
     * @var string
     */
    #[Property(required: true)]
    protected string $arrowSpherePriceBandSku;

    /**
     * @var int
     */
    #[Property(type: 'int', required: true)]
    protected int $quantity;

    /**
     * @var Prices|null
     */
    #[Property(type: Prices::class)]
    protected ?Prices $prices = null;

    /**
     * @var string|null
     */
    #[Property()]
    protected ?string $coterminosityDate = null;

    /**
     * @return string
     */
    public function getArrowSpherePriceBandSku(): string
    {
        return $this->arrowSpherePriceBandSku;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @return Prices|null
     */
    public function getPrices(): ?Prices
    {
        return $this->prices;
    }

    /**
     * @return string|null
     */
    public function getCoterminosityDate(): ?string
    {
        return $this->coterminosityDate;
    }
}
