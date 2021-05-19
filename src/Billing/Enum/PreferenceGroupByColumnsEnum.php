<?php

namespace ArrowSphere\PublicApiClient\Billing\Enum;

use ArrowSphere\PublicApiClient\AbstractEnum;

class PreferenceGroupByColumnsEnum extends AbstractEnum
{
    /**
     * @var string CreatedBy index
     */
    public const CREATED_BY = 'CreatedBy';

    /**
     * @var string ResourceGroup index
     */
    public const RESOURCE_GROUP = 'ResourceGroup';

    /**
     * @var string Name index
     */
    public const NAME = 'Name';

    /**
     * @var string CostCenter index
     */
    public const COST_CENTER = 'CostCenter';

    /**
     * @var string Project index
     */
    public const PROJECT = 'Project';

    /**
     * @var string Application index
     */
    public const APPLICATION = 'Application';

    /**
     * @var string Environment index
     */
    public const ENVIRONMENT = 'Environment';

    /**
     * @var string CustomTag index
     */
    public const CUSTOM_TAG = 'CustomTag';

    /**
     * @var string SubscriptionFriendlyName index
     */
    public const SUBSCRIPTION_FRIENDLY_NAME = 'SubscriptionFriendlyName';

    /**
     * @var string ArsSubscriptionId index
     */
    public const ARS_SUBSCRIPTION_ID = 'ArsSubscriptionId';
}
