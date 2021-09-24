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
                    "banners"     => [
                        [
                            "backgroundImageUuid" => "bbbb-bbb-bbbb-bbb-bb",
                        ],
                        [
                            "backgroundImageUuid" => "ccc-ccc-cccc-ccc-cc",
                        ],
                        [
                            "backgroundImageUuid" => "ddd-ddd-dddd-ddd-dd",
                        ],
                    ],
                    "landingPage" => [
                        "header" => [
                            "backgroundImageUuid" => "eee-eee-eeee-eee-ee",
                            "vendorLogoUuid"      => "fff-fff-fffff-fff-ff",
                        ],
                        "body"   => [
                            "backgroundImageUuid" => "ggg-ggg-gggg-ggg-gg",
                        ],
                    ],
                ],
                'expected' => <<<JSON
{
    "banners": [
        {
            "backgroundImageUuid": "bbbb-bbb-bbbb-bbb-bb",
            "type": "BACKGROUND_COLOR",
            "buttonPlacement": "RIGHT",
            "buttonText": null,
            "text": null,
            "textColor": null
        },
        {
            "backgroundImageUuid": "ccc-ccc-cccc-ccc-cc",
            "type": "BACKGROUND_COLOR",
            "buttonPlacement": "RIGHT",
            "buttonText": null,
            "text": null,
            "textColor": null
        },
        {
            "backgroundImageUuid": "ddd-ddd-dddd-ddd-dd",
            "type": "BACKGROUND_COLOR",
            "buttonPlacement": "RIGHT",
            "buttonText": null,
            "text": null,
            "textColor": null
        }
    ],
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
            "textColor": null
        },
        "body": {
            "backgroundImageUuid": "ggg-ggg-gggg-ggg-gg",
            "type": "",
            "title": "",
            "description": "",
            "videoUrl": null
        },
        "footer": {
            "backgroundColor": "",
            "buttonText": "",
            "buttonUrl": "",
            "features": [],
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
