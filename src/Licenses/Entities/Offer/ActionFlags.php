<?php

namespace ArrowSphere\PublicApiClient\Licenses\Entities\Offer;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

/**
 * Class ActionFlags
 */
class ActionFlags extends AbstractEntity
{
    public const COLUMN_IS_AUTO_RENEW = 'isAutoRenew';

    public const COLUMN_MANUAL_PROVISIONING = 'isManualProvisioning';

    public const COLUMN_RENEWAL_SKU = 'renewalSku';

    protected const VALIDATION_RULES = [
        self::COLUMN_IS_AUTO_RENEW       => 'required|boolean',
        self::COLUMN_MANUAL_PROVISIONING => 'required|boolean',
        self::COLUMN_RENEWAL_SKU         => 'boolean',
    ];

    /**
     * @var bool
     */
    private $isAutoRenew;

    /**
     * @var bool
     */
    private $isManualProvisioning;

    /**
     * @var bool
     */
    private $renewalSku;

    /**
     * ActionFlags constructor.
     *
     * @param array $data
     *
     * @throws EntityValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->isAutoRenew = $data[self::COLUMN_IS_AUTO_RENEW];
        $this->isManualProvisioning = $data[self::COLUMN_MANUAL_PROVISIONING];
        $this->renewalSku = $data[self::COLUMN_RENEWAL_SKU] ?? false;
    }

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

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_IS_AUTO_RENEW       => $this->isAutoRenew,
            self::COLUMN_MANUAL_PROVISIONING => $this->isManualProvisioning,
            self::COLUMN_RENEWAL_SKU         => $this->renewalSku,
        ];
    }
}
