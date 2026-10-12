<?php

namespace ArrowSphere\PublicApiClient\Licenses\Entities\Offer;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;
use ArrowSphere\PublicApiClient\Licenses\Entities\Offer\PriceBand\ActionFlags;
use ArrowSphere\PublicApiClient\Licenses\Entities\Offer\PriceBand\Billing;
use ArrowSphere\PublicApiClient\Licenses\Entities\Offer\PriceBand\Identifiers;
use ArrowSphere\PublicApiClient\Licenses\Entities\Offer\PriceBand\Prices;
use ArrowSphere\PublicApiClient\Licenses\Entities\Offer\PriceBand\SaleConstraints;

/**
 * Class PriceBand
 */
class PriceBand extends AbstractEntity
{
    public const COLUMN_ACTION_FLAGS = 'actionFlags';

    public const COLUMN_BILLING = 'billing';

    public const COLUMN_CURRENCY = 'currency';

    public const COLUMN_IS_ENABLED = 'isEnabled';

    public const COLUMN_MARKETPLACE = 'marketplace';

    public const COLUMN_PRICES = 'prices';

    public const COLUMN_SALE_CONSTRAINTS = 'saleConstraints';

    public const COLUMN_IDENTIFIERS = 'identifiers';

    /**
     * @var bool
     */
    #[Property(name: self::COLUMN_IS_ENABLED, type: 'bool', required: true)]
    protected bool $isEnabled;

    /**
     * @var ActionFlags
     */
    #[Property(name: self::COLUMN_ACTION_FLAGS, type: ActionFlags::class, required: true)]
    protected ActionFlags $actionFlags;

    /**
     * @var Billing
     */
    #[Property(name: self::COLUMN_BILLING, type: Billing::class, required: true)]
    protected Billing $billing;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_CURRENCY, required: true)]
    protected string $currency;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_MARKETPLACE, required: true)]
    protected string $marketplace;

    /**
     * @var Prices
     */
    #[Property(name: self::COLUMN_PRICES, type: Prices::class, required: true)]
    protected Prices $prices;

    /**
     * @var SaleConstraints
     */
    #[Property(name: self::COLUMN_SALE_CONSTRAINTS, type: SaleConstraints::class, required: true)]
    protected SaleConstraints $saleConstraints;

    /**
     * @var Identifiers
     */
    #[Property(name: self::COLUMN_IDENTIFIERS, type: Identifiers::class, required: true)]
    protected Identifiers $identifiers;

    /**
     * @return bool
     */
    public function getIsEnabled(): bool
    {
        return $this->isEnabled;
    }

    /**
     * @return ActionFlags
     */
    public function getActionFlags(): ActionFlags
    {
        return $this->actionFlags;
    }

    /**
     * @return Billing
     */
    public function getBilling(): Billing
    {
        return $this->billing;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @return string
     */
    public function getMarketplace(): string
    {
        return $this->marketplace;
    }

    /**
     * @return Prices
     */
    public function getPrices(): Prices
    {
        return $this->prices;
    }

    /**
     * @return SaleConstraints
     */
    public function getSaleConstraints(): SaleConstraints
    {
        return $this->saleConstraints;
    }

    /**
     * @return Identifiers
     */
    public function Identifiers(): Identifiers
    {
        return $this->identifiers;
    }
}
