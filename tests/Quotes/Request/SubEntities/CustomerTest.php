<?php

namespace ArrowSphere\PublicApiClient\Tests\Quotes\Request\SubEntities;

use ArrowSphere\PublicApiClient\Quotes\Request\SubEntities\Customer;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class CustomerTest extends AbstractEntityTest
{
    protected const CLASS_NAME = Customer::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'reference' => 'my reference',
                ],
                'expected' => <<<JSON
{
    "reference": "my reference"
}
JSON
                ,
            ],
        ];
    }
}
