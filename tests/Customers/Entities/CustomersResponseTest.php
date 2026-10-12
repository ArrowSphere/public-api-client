<?php

namespace ArrowSphere\PublicApiClient\Tests\Customers\Entities;

use ArrowSphere\PublicApiClient\Customers\Entities\CustomersResponse;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class CustomersResponseTest extends AbstractEntityTest
{
    protected const CLASS_NAME = CustomersResponse::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'data'       => [
                        'customers' => [
                            [
                                'AddressLine1'      => 'my address line1',
                                'AddressLine2'      => 'my address line2',
                                'BillingId'         => 'my billing id',
                                'City'              => 'my city',
                                'CompanyName'       => 'my company name',
                                'Contact'           => [
                                    'Email'     => 'my email',
                                    'FirstName' => 'my first name',
                                    'LastName'  => 'my last name',
                                    'Phone'     => 'my phone',
                                ],
                                'CountryCode'       => 'my country code',
                                'Details'           => [
                                    'DomainName'        => 'my domain name',
                                    'IBMCeId'           => 'my ibm ce id',
                                    'Maas360ResellerId' => 'my ibm maas360reseller id',
                                    'Migration'         => true,
                                    'OracleOnlineKey'   => 'my oracle online key',
                                    'TenantId'          => 'my tenant id',
                                ],
                                'DeletedAt'         => 'my deleted at',
                                'EmailContact'      => 'my email contact',
                                'Headcount'         => 2,
                                'InternalReference' => 'my internal reference',
                                'ReceptionPhone'    => 'my reception phone',
                                'Ref'               => 'my ref',
                                'Reference'         => 'my reference',
                                'State'             => 'my state',
                                'TaxNumber'         => 'my tax number',
                                'WebsiteUrl'        => 'my website url',
                                'Zip'               => 'my zip',
                                'OrganizationUnit'  => [
                                    'organizationUnitRef' => 'my organization unit ref',
                                    'companyRef'          => 'my company ref',
                                    'name'                => 'my name',
                                ],
                            ],
                        ],
                    ],
                    'pagination' => [
                        'per_page'     => 10,
                        'current_page' => 1,
                        'total_page'   => 1,
                        'total'        => 1,
                        'next'         => '',
                        'previous'     => '',
                    ],
                ],
                'expected' => <<<JSON
{
    "customers": [
        {
            "AddressLine1": "my address line1",
            "AddressLine2": "my address line2",
            "BillingId": "my billing id",
            "City": "my city",
            "CompanyName": "my company name",
            "Contact": {
                "Email": "my email",
                "FirstName": "my first name",
                "LastName": "my last name",
                "Phone": "my phone"
            },
            "CountryCode": "my country code",
            "Details": {
                "DomainName": "my domain name",
                "IBMCeId": "my ibm ce id",
                "Maas360ResellerId": "my ibm maas360reseller id",
                "Migration": true,
                "OracleOnlineKey": "my oracle online key",
                "TenantId": "my tenant id"
            },
            "DeletedAt": "my deleted at",
            "EmailContact": "my email contact",
            "Headcount": 2,
            "InternalReference": "my internal reference",
            "ReceptionPhone": "my reception phone",
            "Ref": "my ref",
            "Reference": "my reference",
            "State": "my state",
            "TaxNumber": "my tax number",
            "WebsiteUrl": "my website url",
            "Zip": "my zip",
            "OrganizationUnit": {
                "organizationUnitRef": "my organization unit ref",
                "companyRef": "my company ref",
                "name": "my name"
            }
        }
    ],
    "pagination": {
        "per_page": 10,
        "current_page": 1,
        "total_page": 1,
        "total": 1,
        "next": "",
        "previous": ""
    }
}
JSON
                ,
            ],
        ];
    }
}
