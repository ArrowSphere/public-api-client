<?php

namespace ArrowSphere\PublicApiClient\Tests\Campaigns\Entities\LandingPage;

use ArrowSphere\PublicApiClient\Campaigns\Entities\LandingPage\LandingPageFooter;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

/**
 * Class LandingPageFooterTest
 */
class LandingPageFooterTest extends AbstractEntityTest
{
    public const CLASS_NAME = LandingPageFooter::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'backgroundColor'  => 'pink',
                    'buttonText'       => 'cool',
                    'buttonUrl'        => 'story',
                    'feature'          => [
                        'title'       => 'hoot',
                        'description' => 'pouet',
                        'items'       => [],
                    ],
                    'marketingFeature' => [
                        'title'       => 'hoot',
                        'description' => 'pouet',
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
                    'textColor'        => 'red',
                    'title'            => 'bro',
                ],
                'expected' => <<<JSON
{
    "backgroundColor": "pink",
    "buttonText": "cool",
    "buttonUrl": "story",
    "feature": {
        "title": "hoot",
        "description": "pouet",
        "items": []
    },
    "marketingFeature": {
        "title": "hoot",
        "description": "pouet",
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
    },
    "textColor": "red",
    "title": "bro"
}
JSON
                ,
            ],
            'empty'    => [
                'fields'   => [
                    'marketingFeature' => [
                        'items'       => [
                            [
                                'imageUuid' => 'aaaaa-aaaa-aa-aaaaa-aaa',
                            ],
                            [
                                'imageUuid' => 'bbbbb-bbbb-bb-bbbbb-bbb',
                            ],
                            [
                                'imageUuid' => 'ccccc-cccc-cc-ccccc-ccc',
                            ],
                        ],
                    ],
                ],
                'expected' => <<<JSON
{
    "backgroundColor": "",
    "buttonText": "",
    "buttonUrl": "",
    "feature": {
        "title": "",
        "description": "",
        "items": []
    },
    "marketingFeature": {
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
    },
    "textColor": "#FFF",
    "title": ""
}
JSON
                ,
            ],
        ];
    }
}
