<?php

namespace ArrowSphere\PublicApiClient\Licenses\Entities\Offer;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;
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

    protected const VALIDATION_RULES = [
        self::COLUMN_ACTION_FLAGS     => 'required|array',
        self::COLUMN_BILLING          => 'required|array',
        self::COLUMN_CURRENCY         => 'required',
        self::COLUMN_IS_ENABLED       => 'required|boolean',
        self::COLUMN_MARKETPLACE      => 'required',
        self::COLUMN_PRICES           => 'required|array',
        self::COLUMN_SALE_CONSTRAINTS => 'required|array',
        self::COLUMN_IDENTIFIERS      => 'required|array',
    ];

    /**
     * @var bool
     */
    private $isEnabled;

    /**
     * @var ActionFlags
     */
    private $actionFlags;

    /**
     * @var Billing
     */
    private $billing;

    /**
     * @var string
     */
    private $currency;

    /**
     * @var string
     */
    private $marketplace;

    /**
     * @var Prices
     */
    private $prices;

    /**
     * @var SaleConstraints
     */
    private $saleConstraints;

    /**
     * @var Identifiers
     */
    private $identifiers;

    /**
     * PriceBand constructor.
     *
     * @param array $data
     *
     * @throws EntityValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->isEnabled = $data[self::COLUMN_IS_ENABLED];
        $this->actionFlags = new ActionFlags($data[self::COLUMN_ACTION_FLAGS]);
        $this->billing = new Billing($data[self::COLUMN_BILLING]);
        $this->currency = $data[self::COLUMN_CURRENCY];
        $this->marketplace = $data[self::COLUMN_MARKETPLACE];
        $this->prices = new Prices($data[self::COLUMN_PRICES]);
        $this->saleConstraints = new SaleConstraints($data[self::COLUMN_SALE_CONSTRAINTS]);
        $this->identifiers = new Identifiers($data[self::COLUMN_IDENTIFIERS]);
    }

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

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_ACTION_FLAGS     => $this->actionFlags->jsonSerialize(),
            self::COLUMN_BILLING          => $this->billing->jsonSerialize(),
            self::COLUMN_CURRENCY         => $this->currency,
            self::COLUMN_IS_ENABLED       => $this->isEnabled,
            self::COLUMN_MARKETPLACE      => $this->marketplace,
            self::COLUMN_PRICES           => $this->prices->jsonSerialize(),
            self::COLUMN_SALE_CONSTRAINTS => $this->saleConstraints->jsonSerialize(),
            self::COLUMN_IDENTIFIERS      => $this->identifiers->jsonSerialize(),
        ];
    }
}
