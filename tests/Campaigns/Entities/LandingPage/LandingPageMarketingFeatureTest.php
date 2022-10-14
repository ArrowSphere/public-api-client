<?php

namespace ArrowSphere\PublicApiClient\Tests\Campaigns\Entities\LandingPage;

use ArrowSphere\PublicApiClient\Campaigns\Entities\LandingPage\LandingPageMarketingFeature;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

/**
 * Class LandingPageMarketingFeatureTest
 */
class LandingPageMarketingFeatureTest extends AbstractEntityTest
{
    public const CLASS_NAME = LandingPageMarketingFeature::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'title'       => 'cool',
                    'description' => 'story',
                    'items'       => [
                        [
                            'title'       => 'lorem',
                            'description' => 'ipsum',
                            'buttonText'  => 'dolor',
                            'buttonUrl'   => 'sit.amet',
                            'imageUuid'   => 'aaaaa-aaaa-aa-aaaaa-aaa',
                        ],
                        [
                            'title'       => 'lorem',
                            'description' => 'ipsum',
                            'buttonText'  => 'dolor',
                            'buttonUrl'   => 'sit.amet',
                            'imageUuid'   => 'bbbbb-bbbb-bb-bbbbb-bbb',
                        ],
                        [
                            'title'       => 'lorem',
                            'description' => 'ipsum',
                            'buttonText'  => 'dolor',
                            'buttonUrl'   => 'sit.amet',
                            'imageUuid'   => 'ccccc-cccc-cc-ccccc-ccc',
                        ],
                    ],
                ],
                'expected' => <<<JSON
{
    "title": "cool",
    "description": "story",
    "items": [
        {
            "title": "lorem",
            "description": "ipsum",
            "buttonText": "dolor",
            "buttonUrl": "sit.amet",
            "imageUuid": "aaaaa-aaaa-aa-aaaaa-aaa"
        },
        {
            "title": "lorem",
            "description": "ipsum",
            "buttonText": "dolor",
            "buttonUrl": "sit.amet",
            "imageUuid": "bbbbb-bbbb-bb-bbbbb-bbb"
        },
        {
            "title": "lorem",
            "description": "ipsum",
            "buttonText": "dolor",
            "buttonUrl": "sit.amet",
            "imageUuid": "ccccc-cccc-cc-ccccc-ccc"
        }
    ]
}
JSON
                ,

            ],
            'empty'    => [
                'fields'   => [
                    'items' => [
                        [
                            'imageUuid' => 'aaaaa-aaaa-aa-aaaaa-aaa',
                        ],
                        [
                            'imageUuid' => 'bbbbb-bbbb-bb-bbbbb-bbb',
                        ],
                        [
                            'imageUuid' => 'ccccc-cccc-cc-ccccc-ccc',
                        ],
                    ]
                ],
                'expected' => <<<JSON
{
    "title": "",
    "description": "",
    "items": [
        {
            "title": "",
            "description": "",
            "buttonText": "",
            "buttonUrl": "",
            "imageUuid": "aaaaa-aaaa-aa-aaaaa-aaa"
        },
        {
            "title": "",
            "description": "",
            "buttonText": "",
            "buttonUrl": "",
            "imageUuid": "bbbbb-bbbb-bb-bbbbb-bbb"
        },
        {
            "title": "",
            "description": "",
            "buttonText": "",
            "buttonUrl": "",
            "imageUuid": "ccccc-cccc-cc-ccccc-ccc"
        }
    ]
}
JSON
                ,

            ],
        ];
    }
}
