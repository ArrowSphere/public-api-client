<?php

namespace ArrowSphere\PublicApiClient\Tests\Campaigns\Entities\LandingPage;

use ArrowSphere\PublicApiClient\Campaigns\Entities\LandingPage\LandingPageFeatureV2;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

/**
 * Class LandingPageFeatureV2Test
 */
class LandingPageFeatureV2Test extends AbstractEntityTest
{
    public const CLASS_NAME = LandingPageFeatureV2::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'title'       => 'cool',
                    'description' => 'story',
                    'items'       => [],
                ],
                'expected' => <<<JSON
{
    "title": "cool",
    "description": "story",
    "items": []
}
JSON
                ,
            ],
            'empty'    => [
                'fields'   => [
                      'title'       => '',
                      'description' => '',
                      'items'       => [],
                  ],
                'expected' => <<<JSON
{
    "title": "",
    "description": "",
    "items": []
}
JSON
                ,
            ],
        ];
    }
}
