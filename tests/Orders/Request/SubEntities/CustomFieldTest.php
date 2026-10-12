<?php

namespace ArrowSphere\PublicApiClient\Tests\Orders\Request\SubEntities;

use ArrowSphere\PublicApiClient\Orders\Request\SubEntities\CustomField;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class CustomFieldTest extends AbstractEntityTest
{
    protected const CLASS_NAME = CustomField::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'label' => 'my label',
                    'value' => 'my value',
                ],
                'expected' => <<<JSON
{
    "label": "my label",
    "value": "my value"
}
JSON
                ,
            ],
        ];
    }
}
