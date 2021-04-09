<?php

namespace ArrowSphere\PublicApiClient\Tests\Licenses\Entities\Offer;

use ArrowSphere\PublicApiClient\Licenses\Entities\Offer\ActionFlags;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

/**
 * Class ActionFlagsTest
 */
class ActionFlagsTest extends AbstractEntityTest
{
    protected const CLASS_NAME = ActionFlags::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'isAutoRenew'          => true,
                    'isManualProvisioning' => false,
                    'renewalSku'           => false,
                ],
                'expected' => <<<JSON
{
    "isAutoRenew": true,
    "isManualProvisioning": false,
    "renewalSku": false
}
JSON
            ],
        ];
    }
}
