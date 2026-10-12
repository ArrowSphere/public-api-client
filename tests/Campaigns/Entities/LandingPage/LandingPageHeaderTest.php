<?php

namespace ArrowSphere\PublicApiClient\Tests\Campaigns\Entities\LandingPage;

use ArrowSphere\PublicApiClient\Campaigns\Entities\LandingPage\LandingPageHeader;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class LandingPageHeaderTest extends AbstractEntityTest
{
    protected const CLASS_NAME = LandingPageHeader::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'backgroundImageUuid' => 'my background image uuid',
                    'vendorLogoUuid'      => 'my vendor logo uuid',
                    'title'               => 'my title',
                    'backgroundColor'     => 'my background color',
                    'baseline'            => 'my baseline',
                    'textColor'           => 'my text color',
                    'circleColor'         => 'my circle color',
                ],
                'expected' => <<<JSON
{
    "backgroundImageUuid": "my background image uuid",
    "vendorLogoUuid": "my vendor logo uuid",
    "title": "my title",
    "backgroundColor": "my background color",
    "baseline": "my baseline",
    "textColor": "my text color",
    "circleColor": "my circle color"
}
JSON
                ,
            ],
        ];
    }
}
