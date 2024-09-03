<?php

namespace ArrowSphere\PublicApiClient\Quotes\Request\SubEntities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

class Item extends AbstractEntity
{
    public const COLUMN_ARROW_SPHERE_PRICE_BAND_SKU = 'arrowSpherePriceBandSku';
    public const COLUMN_QUANTITY = 'quantity';
    public const COLUMN_PRICES = 'prices';

    #[Property(required: true)]
    protected string $arrowSpherePriceBandSku;

    #[Property(type: 'int', required: true)]
    protected int $quantity;

    #[Property(type: Prices::class)]
    protected ?Prices $prices = null;
}
