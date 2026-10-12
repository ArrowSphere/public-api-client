<?php

namespace ArrowSphere\PublicApiClient\Tests\Campaigns\Entities\LandingPage;

use ArrowSphere\PublicApiClient\Campaigns\Entities\LandingPage\LandingPageMarketingFeatureItem;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class LandingPageMarketingFeatureItemTest extends AbstractEntityTest
{
    protected const CLASS_NAME = LandingPageMarketingFeatureItem::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'title'       => 'my title',
                    'description' => 'my description',
                    'buttonText'  => 'my button text',
                    'buttonUrl'   => 'my button url',
                    'imageUuid'   => 'my image uuid',
                ],
                'expected' => <<<JSON
{
    "title": "my title",
    "description": "my description",
    "buttonText": "my button text",
    "buttonUrl": "my button url",
    "imageUuid": "my image uuid"
}
JSON
                ,
            ],
        ];
    }
}
