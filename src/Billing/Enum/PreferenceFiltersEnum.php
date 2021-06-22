<?php

namespace ArrowSphere\PublicApiClient\Billing\Enum;

use ArrowSphere\PublicApiClient\AbstractEnum;

class PreferenceFiltersEnum extends AbstractEnum
{
    /**
     * @var string BillingType index
     */
    public const BILLING_TYPE = 'BillingType';

    /**
     * @var string VendorName index
     */
    public const VENDOR_NAME = 'VendorName';

    /**
     * @var string CustomerXspRef index
     */
    public const CUSTOMER_XSP_REF = 'CustomerXspRef';
}
