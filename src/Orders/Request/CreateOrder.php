<?php

namespace ArrowSphere\PublicApiClient\Orders\Request;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;
use ArrowSphere\PublicApiClient\Orders\Request\SubEntities\Customer;
use ArrowSphere\PublicApiClient\Orders\Request\SubEntities\ExtraInformation;
use ArrowSphere\PublicApiClient\Orders\Request\SubEntities\Product;

class CreateOrder extends AbstractEntity
{
    public const COLUMN_SCHEDULED_DATE = 'scheduledDate';
    public const COLUMN_EXTRA_INFORMATION = 'extraInformation';
    public const COLUMN_CUSTOMER = 'customer';
    public const COLUMN_PRODUCTS = 'products';
    public const COLUMN_SCENARIO = 'scenario';

    #[Property()]
    protected ?string $scenario = null;
    #[Property()]
    protected ?string $scheduledDate = null;
    #[Property(type: ExtraInformation::class)]
    protected ?ExtraInformation $extraInformation = null;

    #[Property(type: Customer::class, required: true)]
    protected Customer $customer;

    #[Property(type: Product::class, isArray: true, required: true)]
    protected array $products;

    /**
     * @param array{
     *     scenario?: string,
     *     scheduledDate?: string,
     *     extraInformation?: array{programs: array<string,string>},
     *     customer: array{reference: string, poNumber?: string},
     *     products: array{
     *          arrowSpherePriceBandSku:string,
     *          quantity:int,
     *          parentLicenseId?:string,
     *          parentSku?:string,
     *          autoRenew?:bool,
     *          effectiveStartDate?:string,
     *          effectiveEndDate?:string,
     *          vendorReferenceId?:string,
     *          parentVendorReferenceId?:string,
     *          friendlyName?:string,
     *          comment1?:string,
     *          comment2?:string,
     *          discount?:float,
     *          uplift?:float,
     *          promotionId?:string,
     *          coterminosityDate?:string,
     *          coterminositySubscriptionRef?:string,
     *          sku?:string
     *          }
     *     } $data
     *
     * @throws \ArrowSphere\PublicApiClient\Entities\Exception\EntitiesException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);
    }
}
