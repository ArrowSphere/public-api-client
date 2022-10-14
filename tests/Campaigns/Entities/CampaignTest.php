<?php

namespace ArrowSphere\PublicApiClient\Tests\Campaigns\Entities;

use ArrowSphere\PublicApiClient\Campaigns\Entities\Campaign;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

/**
 * Class CampaignTest
 */
class CampaignTest extends AbstractEntityTest
{
    protected const CLASS_NAME = Campaign::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    "reference"   => "aaa-aaa-aaaa-aaa",
                    "name"        => "My campaign",
                    "category"    => "BANNER",
                    "isActivated" => false,
                    "createdAt"   => "2021-06-25T16:00:00Z",
                    "rules"       => [
                        "locations"     => [],
                        "roles"         => [],
                        "marketplaces"  => [],
                        "subscriptions" => [],
                        "resellers"     => [],
                        "endCustomers"  => [],
                    ],
                    "weight"      => 1,
                    "banner"      => [
                        "backgroundImageUuid" => "bbbb-bbb-bbbb-bbb-bb",
                    ],
                    "landingPage" => [
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
                ],
                'expected' => <<<JSON
{
    "banner": {
        "backgroundImageUuid": "bbbb-bbb-bbbb-bbb-bb",
        "backgroundColor": null,
        "type": "BACKGROUND_COLOR",
        "buttonPlacement": "RIGHT",
        "buttonText": null,
        "text": null,
        "textColor": null
    },
    "category": "BANNER",
    "isActivated": false,
    "createdAt": "2021-06-25T16:00:00Z",
    "deletedAt": null,
    "endDate": null,
    "landingPage": {
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
    },
    "name": "My campaign",
    "reference": "aaa-aaa-aaaa-aaa",
    "rules": {
        "locations": [],
        "roles": [],
        "marketplaces": [],
        "subscriptions": [],
        "resellers": [],
        "endCustomers": []
    },
    "startDate": null,
    "updatedAt": null,
    "weight": 1
}
JSON
            ],
        ];
    }
}
