<?php

namespace ArrowSphere\PublicApiClient\Tests\Customers\Request;

use ArrowSphere\PublicApiClient\Customers\Request\ExportCustomersRequest;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class ExportCustomersRequestTest extends AbstractEntityTest
{
    protected const CLASS_NAME = ExportCustomersRequest::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'filters' => [
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
                ],
                'expected' => <<<JSON
{
    "filters": []
}
JSON
                ,
            ],
        ];
    }
}
