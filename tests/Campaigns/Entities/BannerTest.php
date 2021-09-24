<?php

namespace ArrowSphere\PublicApiClient\Tests\Campaigns\Entities;

use ArrowSphere\PublicApiClient\Campaigns\Entities\Banner;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

/**
 * Class BannerTest
 */
class BannerTest extends AbstractEntityTest
{
    protected const CLASS_NAME = Banner::class;

    public function providerSerialization(): array
    {
        return [
            'standard'   => [
                'fields'   => [
                    "backgroundImageUuid" => "bbbb-bbb-bbbb-bbb-bb",
                ],
                'expected' => <<<JSON
{
    "backgroundImageUuid": "bbbb-bbb-bbbb-bbb-bb",
    "type": "BACKGROUND_COLOR",
    "buttonPlacement": "RIGHT",
    "buttonText": null,
    "text": null,
    "textColor": null
}
JSON
                ,
            ],
            'all fields' => [
                'fields'   => [
                    "backgroundImageUuid" => "1111-222-3333-444-55",
                    'type'                => 'my type',
                    'buttonPlacement'     => 'cool',
                    'buttonText'          => 'story',
                    'text'                => 'bro',
                    'textColor'           => 'pink',
                ],
                'expected' => <<<JSON
{
    "backgroundImageUuid": "1111-222-3333-444-55",
    "type": "my type",
    "buttonPlacement": "cool",
    "buttonText": "story",
    "text": "bro",
    "textColor": "pink"
}
JSON
                ,
            ],
        ];
    }
}
