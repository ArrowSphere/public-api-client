<?php

namespace ArrowSphere\PublicApiClient\Orders\Request;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Exception\EntitiesException;
use ArrowSphere\PublicApiClient\Entities\Property;
use ArrowSphere\PublicApiClient\Orders\Request\SubEntities\Customer;
use ArrowSphere\PublicApiClient\Orders\Request\SubEntities\CustomField;
use ArrowSphere\PublicApiClient\Orders\Request\SubEntities\ExtraInformation;
use ArrowSphere\PublicApiClient\Orders\Request\SubEntities\Product;

class CreateOrder extends AbstractEntity
{
    public const COLUMN_SCHEDULED_DATE = 'scheduledDate';
    public const COLUMN_EXTRA_INFORMATION = 'extraInformation';
    public const COLUMN_CUSTOMER = 'customer';
    public const COLUMN_PRODUCTS = 'products';
    public const COLUMN_SCENARIO = 'scenario';
    public const COLUMN_CUSTOM_FIELDS = 'customFields';
    public const COLUMN_QUOTE_REF = 'quoteRef';

    #[Property()]
    protected ?string $scenario = null;
    #[Property(type: CustomField::class, isArray: true)]
    protected ?array $customFields = null;
    #[Property()]
    protected ?string $scheduledDate = null;
    #[Property(type: ExtraInformation::class)]
    protected ?ExtraInformation $extraInformation = null;

    #[Property(type: Customer::class, required: true)]
    protected Customer $customer;

    #[Property(type: Product::class, isArray: true, required: false)]
    protected ?array $products = null;

    #[Property()]
    protected ?string $quoteRef = null;

    /**
     * @param array{
     *     scenario?: string,
     *     scheduledDate?: string,
     *     extraInformation?: array{programs: array<string,string>},
     *     customer: array{reference: string, poNumber?: string},
     *     customFields?: array{label: string, value: string},
     *     quoteRef?: string,
     *     products?: array{
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
     * @throws EntitiesException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        if ($this->quoteRef === null && empty($this->products)) {
            throw new EntitiesException(
                self::class . ': At least one of quoteRef or products must be provided'
            );
        }
    }
}
