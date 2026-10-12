<?php

namespace ArrowSphere\PublicApiClient\Tests\Campaigns\Entities\LandingPage;

use ArrowSphere\PublicApiClient\Campaigns\Entities\LandingPage\LandingPageFeatureItem;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class LandingPageFeatureItemTest extends AbstractEntityTest
{
    protected const CLASS_NAME = LandingPageFeatureItem::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'title'       => 'my title',
                    'description' => 'my description',
                    'icon'        => 'my icon',
                    'size'        => 2,
                    'buttonText'  => 'my button text',
                    'buttonUrl'   => 'my button url',
                ],
                'expected' => <<<JSON
{
    "title": "my title",
    "description": "my description",
    "icon": "my icon",
    "size": 2,
    "buttonText": "my button text",
    "buttonUrl": "my button url"
}
JSON
                ,
            ],
        ];
    }
}
