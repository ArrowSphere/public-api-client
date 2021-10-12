<?php

namespace ArrowSphere\PublicApiClient\Tests\Campaigns\Entities\LandingPage;

use ArrowSphere\PublicApiClient\Campaigns\Entities\LandingPage\LandingPageBody;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class LandingPageBodyTest extends AbstractEntityTest
{
    public const CLASS_NAME = LandingPageBody::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'backgroundImageUuid' => 'aaa-bbb-ccc',
                    'type'                => 'cool',
                    'title'               => 'story',
                    'description'         => 'bro',
                    'videoUrl'            => 'my video url',
                    'buttonText'          => null,
                    'contactEmail'        => null,
                ],
                'expected' => <<<JSON
{
    "backgroundImageUuid": "aaa-bbb-ccc",
    "type": "cool",
    "title": "story",
    "description": "bro",
    "videoUrl": "my video url",
    "buttonText": null,
    "contactEmail": null
}
JSON
                ,
            ],
            'empty'    => [
                'fields'   => [

                ],
                'expected' => <<<JSON
{
    "backgroundImageUuid": "",
    "type": "",
    "title": "",
    "description": "",
    "videoUrl": null,
    "buttonText": null,
    "contactEmail": null
}
JSON
                ,
            ],
        ];
    }
}
