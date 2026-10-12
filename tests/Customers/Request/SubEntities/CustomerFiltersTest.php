<?php

namespace ArrowSphere\PublicApiClient\Tests\Customers\Request\SubEntities;

use ArrowSphere\PublicApiClient\Customers\Request\SubEntities\CustomerFilters;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class CustomerFiltersTest extends AbstractEntityTest
{
    protected const CLASS_NAME = CustomerFilters::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'billingId'         => 'my billing id',
                    'city'              => 'my city',
                    'acronym'           => 'my acronym',
                    'resellerName'      => 'my reseller name',
                    'companyName'       => 'my company name',
                    'country'           => 'my country',
                    'internalReference' => 'my internal reference',
                    'companyId'         => 'my company id',
                    'state'             => 'my state',
                    'zip'               => 'my zip',
                    'creationDate'      => 'my creation date',
                ],
                'expected' => <<<JSON
[]
JSON
                ,
            ],
        ];
    }
}
