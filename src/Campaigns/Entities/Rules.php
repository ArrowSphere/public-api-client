<?php

namespace ArrowSphere\PublicApiClient\Campaigns\Entities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

class Rules extends AbstractEntity
{
    public const COLUMN_LOCATIONS = 'locations';
    public const COLUMN_ROLES = 'roles';
    public const COLUMN_MARKETPLACES = 'marketplaces';
    public const COLUMN_SUBSCRIPTIONS = 'subscriptions';
    public const COLUMN_RESELLERS = 'resellers';
    public const COLUMN_ENDCUSTOMERS = 'endCustomers';

    public const DEFAULT_VALUE_LOCATIONS = [];
    public const DEFAULT_VALUE_ROLES = [];
    public const DEFAULT_VALUE_MARKETPLACES = [];
    public const DEFAULT_VALUE_SUBSCRIPTIONS = [];
    public const DEFAULT_VALUE_RESELLERS = [];
    public const DEFAULT_VALUE_ENDCUSTOMERS = [];

    /**
     * @var string[]
     */
    #[Property(name: self::COLUMN_LOCATIONS, isArray: true)]
    protected array $locations = self::DEFAULT_VALUE_LOCATIONS;

    /**
     * @var string[]
     */
    #[Property(name: self::COLUMN_ROLES, isArray: true)]
    protected array $roles = self::DEFAULT_VALUE_ROLES;

    /**
     * @var string[]
     */
    #[Property(name: self::COLUMN_MARKETPLACES, isArray: true)]
    protected array $marketplaces = self::DEFAULT_VALUE_MARKETPLACES;

    /**
     * @var string[]
     */
    #[Property(name: self::COLUMN_SUBSCRIPTIONS, isArray: true)]
    protected array $subscriptions = self::DEFAULT_VALUE_SUBSCRIPTIONS;

    /**
     * @var string[]
     */
    #[Property(name: self::COLUMN_RESELLERS, isArray: true)]
    protected array $resellers = self::DEFAULT_VALUE_RESELLERS;

    /**
     * @var string[]
     */
    #[Property(name: self::COLUMN_ENDCUSTOMERS, isArray: true)]
    protected array $endCustomers = self::DEFAULT_VALUE_ENDCUSTOMERS;

    /**
     * @return string[]
     */
    public function getLocations(): array
    {
        return $this->locations;
    }

    /**
     * @return string[]
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * @return string[]
     */
    public function getMarketplaces(): array
    {
        return $this->marketplaces;
    }

    /**
     * @return string[]
     */
    public function getSubscriptions(): array
    {
        return $this->subscriptions;
    }

    /**
     * @return string[]
     */
    public function getResellers(): array
    {
        return $this->resellers;
    }

    /**
     * @return string[]
     */
    public function getEndCustomers(): array
    {
        return $this->endCustomers;
    }
}
