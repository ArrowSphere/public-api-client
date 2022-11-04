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
                    'backgroundColor' => 'pink',
                    'buttonText'      => 'cool',
                    'buttonUrl'       => 'story',
                    'features'        => [
                        [
                            'title'       => 'feature title',
                            'description' => 'feature description',
                            'icon'        => 'feature icon',
                            'size'        => 42,
                        ],
                        [
                            'title'       => 'feature title 2',
                            'description' => 'feature description 2',
                            'icon'        => 'feature icon 2',
                            'size'        => 84,
                        ],
                    ],
                    'textColor'       => 'red',
                    'title'           => 'bro',
                ],
                'expected' => <<<JSON
{
    "backgroundColor": "pink",
    "buttonText": "cool",
    "buttonUrl": "story",
    "features": [
        {
            "title": "feature title",
            "description": "feature description",
            "icon": "feature icon",
            "size": 42
        },
        {
            "title": "feature title 2",
            "description": "feature description 2",
            "icon": "feature icon 2",
            "size": 84
        }
    ],
    "textColor": "red",
    "title": "bro"
}
JSON
                ,
            ],
            'empty'    => [
                'fields'   => [],
                'expected' => <<<JSON
{
    "backgroundColor": "",
    "buttonText": "",
    "buttonUrl": "",
    "features": [],
    "textColor": "#FFF",
    "title": ""
}
JSON
                ,
            ],
        ];
    }
}
