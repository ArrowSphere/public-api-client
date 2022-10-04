<?php

namespace ArrowSphere\PublicApiClient\Customers\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

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

    protected const VALIDATION_RULES = [
        self::COLUMN_MIGRATION => 'boolean',
    ];

    /**
     * @var string|null
     */
    private $domainName;

    /**
     * @var string
     */
    private $ibmCeId;

    /**
     * @var string
     */
    private $ibmMaas360ResellerId;

    /**
     * @var bool|null
     */
    private $migration;

    /**
     * @var string|null
     */
    private $oracleOnlineKey;

    /**
     * @var string|null
     */
    private $tenantId;

    /**
     * CompanyDetails constructor.
     *
     * @param array $data
     *
     * @throws EntityValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->domainName = $data[self::COLUMN_DOMAIN_NAME] ?? null;
        $this->ibmCeId = $data[self::COLUMN_IBM_CE_ID] ?? null;
        $this->ibmMaas360ResellerId = $data[self::COLUMN_IBM_MAAS_360_RESELLER_ID] ?? null;
        $this->migration = $data[self::COLUMN_MIGRATION] ?? null;
        $this->oracleOnlineKey = $data[self::COLUMN_ORACLE_ONLINE_KEY] ?? null;
        $this->tenantId = $data[self::COLUMN_TENANT_ID] ?? null;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return array_filter([
            self::COLUMN_DOMAIN_NAME              => $this->domainName,
            self::COLUMN_IBM_CE_ID                => $this->ibmCeId,
            self::COLUMN_IBM_MAAS_360_RESELLER_ID => $this->ibmMaas360ResellerId,
            self::COLUMN_MIGRATION                => $this->migration,
            self::COLUMN_ORACLE_ONLINE_KEY        => $this->oracleOnlineKey,
            self::COLUMN_TENANT_ID                => $this->tenantId,
        ], static function ($val) {
            return $val !== null;
        });
    }

    /**
     * @return string|null
     */
    public function getDomainName(): ?string
    {
        return $this->domainName;
    }

    /**
     * @return string
     */
    public function getIbmCeId(): ?string
    {
        return $this->ibmCeId;
    }

    /**
     * @return string
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
