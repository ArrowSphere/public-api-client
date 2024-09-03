<?php

namespace ArrowSphere\PublicApiClient\Quotes\Request\SubEntities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

class Prices extends AbstractEntity
{
    public const COLUMN_CUSTOMER = 'customer';

    #[Property(type: CustomerPrices::class, required: true)]
    protected CustomerPrices $customer;
}
