<?php

namespace ArrowSphere\PublicApiClient\Licenses\Entities\Offer;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

/**
 * Class ActionFlags
 */
class ActionFlags extends AbstractEntity
{
    public const COLUMN_IS_AUTO_RENEW = 'isAutoRenew';

    public const COLUMN_MANUAL_PROVISIONING = 'isManualProvisioning';

    public const COLUMN_RENEWAL_SKU = 'renewalSku';

    /**
     * @var bool
     */
    #[Property(name: self::COLUMN_IS_AUTO_RENEW, type: 'bool')]
    protected bool $isAutoRenew = false;

    /**
     * @var bool
     */
    #[Property(name: self::COLUMN_MANUAL_PROVISIONING, type: 'bool')]
    protected bool $isManualProvisioning = false;

    /**
     * @var bool
     */
    #[Property(name: self::COLUMN_RENEWAL_SKU, type: 'bool')]
    protected bool $renewalSku = false;

    /**
     * @return bool
     */
    public function getIsAutoRenew(): bool
    {
        return $this->isAutoRenew;
    }

    /**
     * @return bool
     */
    public function getIsManualProvisioning(): bool
    {
        return $this->isManualProvisioning;
    }

    /**
     * @return bool
     */
    public function getIsRenewalSku(): bool
    {
        return $this->renewalSku;
    }
}
