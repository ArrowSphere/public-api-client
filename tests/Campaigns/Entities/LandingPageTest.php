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
}
JSON
                ,
            ],
        ];
    }
}
