<?php

namespace ArrowSphere\PublicApiClient\Tests\Campaigns\Entities\Asset;

use ArrowSphere\PublicApiClient\Campaigns\Entities\Asset\Asset;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

/**
 * Class AssetTest
 */
class AssetTest extends AbstractEntityTest
{
    public const CLASS_NAME = Asset::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'uuid' => 'aaaa-bbbb-cccc',
                    'url'  => 'https://www.example.com',
                ],
                'expected' => <<<JSON
{
    "uuid": "aaaa-bbbb-cccc",
    "url": "https:\/\/www.example.com"
}
JSON
                ,
            ],
        ];
    }
}
