<?php

namespace ArrowSphere\PublicApiClient\Orders\Request\SubEntities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

class Product extends AbstractEntity
{
    public const COLUMN_ARROW_SPHERE_PRICE_BAND_SKU = 'arrowSpherePriceBandSku';
    public const COLUMN_QUANTITY = 'quantity';
    public const COLUMN_PARENT_LICENSE_ID = 'parentLicenseId';
    public const COLUMN_PARENT_SKU = 'parentSku';
    public const COLUMN_AUTO_RENEW = 'autoRenew';
    public const COLUMN_EFFECTIVE_START_DATE = 'effectiveStartDate';
    public const COLUMN_EFFECTIVE_END_DATE = 'effectiveEndDate';
    public const COLUMN_VENDOR_REFERENCE_ID = 'vendorReferenceId';
    public const COLUMN_PARENT_VENDOR_REFERENCE_ID = 'parentVendorReferenceId';
    public const COLUMN_FRIENDLY_NAME = 'friendlyName';
    public const COLUMN_COMMENT1 = 'comment1';
    public const COLUMN_COMMENT2 = 'comment2';
    public const COLUMN_DISCOUNT = 'discount';
    public const COLUMN_UPLIFT = 'uplift';
    public const COLUMN_PROMOTION_ID = 'promotionId';
    public const COLUMN_COTERMINOSITY_DATE = 'coterminosityDate';
    public const COLUMN_COTERMINOSITY_SUBSCRIPTION_REF = 'coterminositySubscriptionRef';
    public const COLUMN_SKU = 'sku';

    #[Property(required: true)]
    protected string $arrowSpherePriceBandSku;

    #[Property(type: 'int', required: true)]
    protected int $quantity;

    #[Property()]
    protected ?string $parentLicenseId = null;

    #[Property()]
    protected ?string $parentSku = null;

    #[Property(type: 'bool')]
    protected ?bool $autoRenew = null;

    #[Property()]
    protected ?string $effectiveStartDate = null;

    #[Property()]
    protected ?string $effectiveEndDate = null;

    #[Property()]
    protected ?string $vendorReferenceId = null;

    #[Property()]
    protected ?string $parentVendorReferenceId = null;

    #[Property()]
    protected ?string $friendlyName = null;

    #[Property()]
    protected ?string $comment1 = null;

    #[Property()]
    protected ?string $comment2 = null;

    #[Property(type: 'float')]
    protected ?float $discount = null;

    #[Property(type: 'float')]
    protected ?float $uplift = null;

    #[Property()]
    protected ?string $promotionId = null;

    #[Property()]
    protected ?string $coterminosityDate = null;

    #[Property()]
    protected ?string $coterminositySubscriptionRef = null;

    #[Property()]
    protected ?string $sku = null;
}
