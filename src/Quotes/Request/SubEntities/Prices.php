<?php

namespace ArrowSphere\PublicApiClient\Quotes\Request\SubEntities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

class Prices extends AbstractEntity
{
    public const COLUMN_ARROW = 'arrow';
    public const COLUMN_CUSTOMER = 'customer';
    public const COLUMN_PARTNER = 'partner';

    /**
     * @var CustomerPrices|null
     */
    #[Property(type: CustomerPrices::class)]
    protected ?CustomerPrices $arrow = null;

    /**
     * @var CustomerPrices|null
     */
    #[Property(type: CustomerPrices::class)]
    protected ?CustomerPrices $customer = null;

    /**
     * @var CustomerPrices|null
     */
    #[Property(type: CustomerPrices::class)]
    protected ?CustomerPrices $partner = null;

    /**
     * @return CustomerPrices|null
     */
    public function getArrow(): ?CustomerPrices
    {
        return $this->arrow;
    }

    /**
     * @return CustomerPrices|null
     */
    public function getCustomer(): ?CustomerPrices
    {
        return $this->customer;
    }

    /**
     * @return CustomerPrices|null
     */
    public function getPartner(): ?CustomerPrices
    {
        return $this->partner;
    }
}
