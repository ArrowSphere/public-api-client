<?php

namespace ArrowSphere\PublicApiClient\Campaigns\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

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
    private $locations;

    /**
     * @var string[]
     */
    private $roles;

    /**
     * @var string[]
     */
    private $marketplaces;

    /**
     * @var string[]
     */
    private $subscriptions;

    /**
     * @var string[]
     */
    private $resellers;

    /**
     * @var string[]
     */
    private $endCustomers;

    /**
     * Statement constructor.
     *
     * @param array $data
     *
     * @throws EntityValidationException
     * @throws \ReflectionException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->locations = $data[self::COLUMN_LOCATIONS] ?? self::DEFAULT_VALUE_LOCATIONS;
        $this->roles = $data[self::COLUMN_ROLES] ?? self::DEFAULT_VALUE_ROLES;
        $this->marketplaces = $data[self::COLUMN_MARKETPLACES] ?? self::DEFAULT_VALUE_MARKETPLACES;
        $this->subscriptions = $data[self::COLUMN_SUBSCRIPTIONS] ?? self::DEFAULT_VALUE_SUBSCRIPTIONS;
        $this->resellers = $data[self::COLUMN_RESELLERS] ?? self::DEFAULT_VALUE_RESELLERS;
        $this->endCustomers = $data[self::COLUMN_ENDCUSTOMERS] ?? self::DEFAULT_VALUE_ENDCUSTOMERS;
    }

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

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_LOCATIONS     => $this->getLocations(),
            self::COLUMN_ROLES         => $this->getRoles(),
            self::COLUMN_MARKETPLACES  => $this->getMarketplaces(),
            self::COLUMN_SUBSCRIPTIONS => $this->getSubscriptions(),
            self::COLUMN_RESELLERS     => $this->getResellers(),
            self::COLUMN_ENDCUSTOMERS  => $this->getEndCustomers(),
        ];
    }
}
