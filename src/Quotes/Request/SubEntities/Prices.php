<?php

namespace ArrowSphere\PublicApiClient\Quotes\Request\SubEntities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

class Prices extends AbstractEntity
{
    public const COLUMN_ARROW = 'arrow';
    public const COLUMN_CUSTOMER = 'customer';
    public const COLUMN_PARTNER = 'partner';

    #[Property(type: CustomerPrices::class)]
    protected ?CustomerPrices $arrow = null;

    #[Property(type: CustomerPrices::class)]
    protected ?CustomerPrices $customer = null;

    #[Property(type: CustomerPrices::class)]
    protected ?CustomerPrices $partner = null;
}
