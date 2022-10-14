<?php

namespace ArrowSphere\PublicApiClient\Tests\Campaigns\Entities;

use ArrowSphere\PublicApiClient\Campaigns\Entities\LandingPage;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

/**
 * Class LandingPageTest
 */
class LandingPageTest extends AbstractEntityTest
{
    protected const CLASS_NAME = LandingPage::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    "header" => [
                        "backgroundImageUuid" => "eee-eee-eeee-eee-ee",
                        "vendorLogoUuid"      => "fff-fff-fffff-fff-ff",
                    ],
                    "body"   => [
                        "backgroundImageUuid" => "ggg-ggg-gggg-ggg-gg",
                    ],
                    "footer" => [
                        "marketingFeature" => [
                            "items" => [
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
                        ]
                    ]
                ],
                'expected' => <<<JSON
{
    "url": null,
    "header": {
        "backgroundImageUuid": "eee-eee-eeee-eee-ee",
        "vendorLogoUuid": "fff-fff-fffff-fff-ff",
        "title": "",
        "backgroundColor": null,
        "baseline": "",
        "textColor": null,
        "circleColor": null
    },
    "body": {
        "backgroundImageUuid": "ggg-ggg-gggg-ggg-gg",
        "type": "",
        "title": "",
        "description": "",
        "videoUrl": null,
        "buttonText": null,
        "contactEmail": null
    },
    "footer": {
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
}
JSON
                ,
            ],
        ];
    }
}
