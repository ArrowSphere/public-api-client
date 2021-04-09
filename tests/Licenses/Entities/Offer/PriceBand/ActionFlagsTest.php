<?php

namespace ArrowSphere\PublicApiClient\Tests\Licenses\Entities\Offer\PriceBand;

use ArrowSphere\PublicApiClient\Licenses\Entities\Offer\PriceBand\ActionFlags;
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
                    'canBeCancelled'   => true,
                    'canBeReactivated' => true,
                    'canBeSuspended'   => true,
                    'canDecreaseSeats' => true,
                    'canIncreaseSeats' => true,
                ],
                'expected' => <<<JSON
{
    "canBeCancelled": true,
    "canBeReactivated": true,
    "canBeSuspended": true,
    "canDecreaseSeats": true,
    "canIncreaseSeats": true
}
JSON
            ],
        ];
    }
}
