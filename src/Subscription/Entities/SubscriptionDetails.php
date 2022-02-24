<?php

namespace ArrowSphere\PublicApiClient\Subscription\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

/**
 * Class CompanyDetails
 */
class SubscriptionDetails extends AbstractEntity
{

    public const COLUMN_MPN_ID = 'mpnid';

    public const COLUMN_SALES_GUID = 'sales_guid';

    public const COLUMN_ADMIN_GUID = 'admin_guid';

    public const COLUMN_HELPDESK_GUID = 'helpdesk_guid';

    public const COLUMN_TENANT_ID = 'tenantid';

    public const COLUMN_IAAS_DISCOUNT_RATE = 'iaasDiscountRate';

    public const COLUMN_IAAS_DISCOUNT_RATE_UNIT = 'iaasDiscountRateUnit';

    /** @var string|null */
    private $salesGuid;

    /** @var string|null */
    private $adminGuid;

    /** @var string|null */
    private $helpdeskGuid;

    /** @var string|null */
    private $tenantId;

    /** @var string|null */
    private $iaasDiscountRate;

    /** @var string|null */
    private $iaasDiscountRateUnit;

    /** @var string|null */
    private $mpnId;

    /**
     * @param array $data
     *
     * @throws EntityValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->mpnId = $data[self::COLUMN_MPN_ID] ?? null;
        $this->salesGuid = $data[self::COLUMN_SALES_GUID] ?? null;
        $this->adminGuid = $data[self::COLUMN_ADMIN_GUID] ?? null;
        $this->helpdeskGuid = $data[self::COLUMN_HELPDESK_GUID] ?? null;
        $this->tenantId = $data[self::COLUMN_TENANT_ID] ?? null;
        $this->iaasDiscountRate = $data[self::COLUMN_IAAS_DISCOUNT_RATE] ?? null;
        $this->iaasDiscountRateUnit = $data[self::COLUMN_IAAS_DISCOUNT_RATE_UNIT] ?? null;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_MPN_ID                  => $this->mpnId,
            self::COLUMN_SALES_GUID              => $this->salesGuid,
            self::COLUMN_ADMIN_GUID              => $this->adminGuid,
            self::COLUMN_HELPDESK_GUID           => $this->helpdeskGuid,
            self::COLUMN_TENANT_ID               => $this->tenantId,
            self::COLUMN_IAAS_DISCOUNT_RATE      => $this->iaasDiscountRate,
            self::COLUMN_IAAS_DISCOUNT_RATE_UNIT => $this->iaasDiscountRateUnit,
        ];
    }

    /**
     * @return string|null
     */
    public function getSalesGuid()
    {
        return $this->salesGuid;
    }

    /**
     * @param string|null $salesGuid
     *
     * @return SubscriptionDetails
     */
    public function setSalesGuid(?string $salesGuid): SubscriptionDetails
    {
        $this->salesGuid = $salesGuid;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAdminGuid()
    {
        return $this->adminGuid;
    }

    /**
     * @param string|null $adminGuid
     *
     * @return SubscriptionDetails
     */
    public function setAdminGuid(?string $adminGuid): SubscriptionDetails
    {
        $this->adminGuid = $adminGuid;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getHelpdeskGuid()
    {
        return $this->helpdeskGuid;
    }

    /**
     * @param string|null $helpdeskGuid
     *
     * @return SubscriptionDetails
     */
    public function setHelpdeskGuid(?string $helpdeskGuid): SubscriptionDetails
    {
        $this->helpdeskGuid = $helpdeskGuid;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTenantId()
    {
        return $this->tenantId;
    }

    /**
     * @param string|null $tenantId
     *
     * @return SubscriptionDetails
     */
    public function setTenantId(?string $tenantId): SubscriptionDetails
    {
        $this->tenantId = $tenantId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getIaasDiscountRate()
    {
        return $this->iaasDiscountRate;
    }

    /**
     * @param string|null $iaasDiscountRate
     *
     * @return SubscriptionDetails
     */
    public function setIaasDiscountRate(?string $iaasDiscountRate): SubscriptionDetails
    {
        $this->iaasDiscountRate = $iaasDiscountRate;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getIaasDiscountRateUnit()
    {
        return $this->iaasDiscountRateUnit;
    }

    /**
     * @param string|null $iaasDiscountRateUnit
     *
     * @return SubscriptionDetails
     */
    public function setIaasDiscountRateUnit(?string $iaasDiscountRateUnit): SubscriptionDetails
    {
        $this->iaasDiscountRateUnit = $iaasDiscountRateUnit;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMpnId()
    {
        return $this->mpnId;
    }

    /**
     * @param string|null $mpnId
     *
     * @return SubscriptionDetails
     */
    public function setMpnId(?string $mpnId): SubscriptionDetails
    {
        $this->mpnId = $mpnId;

        return $this;
    }
}
