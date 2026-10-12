<?php

namespace ArrowSphere\PublicApiClient\Tests\Orders\Request\SubEntities;

use ArrowSphere\PublicApiClient\Orders\Request\SubEntities\Product;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

class ProductTest extends AbstractEntityTest
{
    protected const CLASS_NAME = Product::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'arrowSpherePriceBandSku'      => 'my arrow sphere price band sku',
                    'quantity'                     => 2,
                    'parentLicenseId'              => 'my parent license id',
                    'parentSku'                    => 'my parent sku',
                    'autoRenew'                    => true,
                    'effectiveStartDate'           => 'my effective start date',
                    'effectiveEndDate'             => 'my effective end date',
                    'vendorReferenceId'            => 'my vendor reference id',
                    'parentVendorReferenceId'      => 'my parent vendor reference id',
                    'friendlyName'                 => 'my friendly name',
                    'comment1'                     => 'my comment1',
                    'comment2'                     => 'my comment2',
                    'discount'                     => 12.5,
                    'uplift'                       => 12.5,
                    'promotionId'                  => 'my promotion id',
                    'coterminosityDate'            => 'my coterminosity date',
                    'coterminositySubscriptionRef' => 'my coterminosity subscription ref',
                    'sku'                          => 'my sku',
                    'bundleArrowSphereSku'         => 'my bundle arrow sphere sku',
                    'bundleUuid'                   => 'my bundle uuid',
                ],
                'expected' => <<<JSON
{
    "arrowSpherePriceBandSku": "my arrow sphere price band sku",
    "quantity": 2,
    "parentLicenseId": "my parent license id",
    "parentSku": "my parent sku",
    "autoRenew": true,
    "effectiveStartDate": "my effective start date",
    "effectiveEndDate": "my effective end date",
    "vendorReferenceId": "my vendor reference id",
    "parentVendorReferenceId": "my parent vendor reference id",
    "friendlyName": "my friendly name",
    "comment1": "my comment1",
    "comment2": "my comment2",
    "discount": 12.5,
    "uplift": 12.5,
    "promotionId": "my promotion id",
    "coterminosityDate": "my coterminosity date",
    "coterminositySubscriptionRef": "my coterminosity subscription ref",
    "sku": "my sku",
    "bundleArrowSphereSku": "my bundle arrow sphere sku",
    "bundleUuid": "my bundle uuid"
}
JSON
                ,
            ],
        ];
    }
}
