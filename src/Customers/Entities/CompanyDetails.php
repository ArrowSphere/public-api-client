<?php

namespace ArrowSphere\PublicApiClient\Customers\Entities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

/**
 * Class CompanyDetails
 */
class CompanyDetails extends AbstractEntity
{
    public const COLUMN_DOMAIN_NAME = 'DomainName';

    public const COLUMN_IBM_CE_ID = 'IBMCeId';

    public const COLUMN_IBM_MAAS_360_RESELLER_ID = 'Maas360ResellerId';

    public const COLUMN_MIGRATION = 'Migration';

    public const COLUMN_ORACLE_ONLINE_KEY = 'OracleOnlineKey';

    public const COLUMN_TENANT_ID = 'TenantId';

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_DOMAIN_NAME)]
    protected ?string $domainName = null;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_IBM_CE_ID)]
    protected ?string $ibmCeId = null;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_IBM_MAAS_360_RESELLER_ID)]
    protected ?string $ibmMaas360ResellerId = null;

    /**
     * @var bool|null
     */
    #[Property(name: self::COLUMN_MIGRATION, type: 'bool')]
    protected ?bool $migration = null;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_ORACLE_ONLINE_KEY)]
    protected ?string $oracleOnlineKey = null;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_TENANT_ID)]
    protected ?string $tenantId = null;

    /**
     * @return string|null
     */
    public function getDomainName(): ?string
    {
        return $this->domainName;
    }

    /**
     * @return string|null
     */
    public function getIbmCeId(): ?string
    {
        return $this->ibmCeId;
    }

    /**
     * @return string|null
     */
    public function getIbmMaas360ResellerId(): ?string
    {
        return $this->ibmMaas360ResellerId;
    }

    /**
     * @return bool|null
     */
    public function getMigration(): ?bool
    {
        return $this->migration;
    }

    /**
     * @return string|null
     */
    public function getOracleOnlineKey(): ?string
    {
        return $this->oracleOnlineKey;
    }

    /**
     * @return string|null
     */
    public function getTenantId(): ?string
    {
        return $this->tenantId;
    }
}
