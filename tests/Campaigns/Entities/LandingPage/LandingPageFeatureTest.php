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
