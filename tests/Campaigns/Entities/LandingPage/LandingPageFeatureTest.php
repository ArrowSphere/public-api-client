<?php

namespace ArrowSphere\PublicApiClient\Tests\Campaigns\Entities\LandingPage;

use ArrowSphere\PublicApiClient\Campaigns\Entities\LandingPage\LandingPageFeature;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

/**
 * Class LandingPageFeatureTest
 */
class LandingPageFeatureTest extends AbstractEntityTest
{
    public const CLASS_NAME = LandingPageFeature::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'title'       => 'cool',
                    'description' => 'story',
                    'icon'        => 'bro',
                    'size'        => 42,
                ],
                'expected' => <<<JSON
{
    "title": "cool",
    "description": "story",
    "icon": "bro",
    "size": 42
}
JSON
                ,

            ],
            'empty'    => [
                'fields'   => [],
                'expected' => <<<JSON
{
    "title": "",
    "description": "",
    "icon": "",
    "size": 4
}
JSON
                ,

            ],
        ];
    }
}
