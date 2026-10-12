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
    public const COLUMN_BUNDLE_ARROW_SPHERE_SKU = 'bundleArrowSphereSku';
    public const COLUMN_BUNDLE_UUID = 'bundleUuid';

    /**
     * @var string
     */
    #[Property(required: true)]
    protected string $arrowSpherePriceBandSku;

    /**
     * @var int
     */
    #[Property(type: 'int', required: true)]
    protected int $quantity;

    /**
     * @var string|null
     */
    #[Property()]
    protected ?string $parentLicenseId = null;

    /**
     * @var string|null
     */
    #[Property()]
    protected ?string $parentSku = null;

    /**
     * @var bool|null
     */
    #[Property(type: 'bool')]
    protected ?bool $autoRenew = null;

    /**
     * @var string|null
     */
    #[Property()]
    protected ?string $effectiveStartDate = null;

    /**
     * @var string|null
     */
    #[Property()]
    protected ?string $effectiveEndDate = null;

    /**
     * @var string|null
     */
    #[Property()]
    protected ?string $vendorReferenceId = null;

    /**
     * @var string|null
     */
    #[Property()]
    protected ?string $parentVendorReferenceId = null;

    /**
     * @var string|null
     */
    #[Property()]
    protected ?string $friendlyName = null;

    /**
     * @var string|null
     */
    #[Property()]
    protected ?string $comment1 = null;

    /**
     * @var string|null
     */
    #[Property()]
    protected ?string $comment2 = null;

    /**
     * @var float|null
     */
    #[Property(type: 'float')]
    protected ?float $discount = null;

    /**
     * @var float|null
     */
    #[Property(type: 'float')]
    protected ?float $uplift = null;

    /**
     * @var string|null
     */
    #[Property()]
    protected ?string $promotionId = null;

    /**
     * @var string|null
     */
    #[Property()]
    protected ?string $coterminosityDate = null;

    /**
     * @var string|null
     */
    #[Property()]
    protected ?string $coterminositySubscriptionRef = null;

    /**
     * @var string|null
     */
    #[Property()]
    protected ?string $sku = null;

    /**
     * @var string|null
     */
    #[Property()]
    protected ?string $bundleArrowSphereSku = null;

    /**
     * @var string|null
     */
    #[Property()]
    protected ?string $bundleUuid = null;

    /**
     * @return string
     */
    public function getArrowSpherePriceBandSku(): string
    {
        return $this->arrowSpherePriceBandSku;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @return string|null
     */
    public function getParentLicenseId(): ?string
    {
        return $this->parentLicenseId;
    }

    /**
     * @return string|null
     */
    public function getParentSku(): ?string
    {
        return $this->parentSku;
    }

    /**
     * @return bool|null
     */
    public function getAutoRenew(): ?bool
    {
        return $this->autoRenew;
    }

    /**
     * @return string|null
     */
    public function getEffectiveStartDate(): ?string
    {
        return $this->effectiveStartDate;
    }

    /**
     * @return string|null
     */
    public function getEffectiveEndDate(): ?string
    {
        return $this->effectiveEndDate;
    }

    /**
     * @return string|null
     */
    public function getVendorReferenceId(): ?string
    {
        return $this->vendorReferenceId;
    }

    /**
     * @return string|null
     */
    public function getParentVendorReferenceId(): ?string
    {
        return $this->parentVendorReferenceId;
    }

    /**
     * @return string|null
     */
    public function getFriendlyName(): ?string
    {
        return $this->friendlyName;
    }

    /**
     * @return string|null
     */
    public function getComment1(): ?string
    {
        return $this->comment1;
    }

    /**
     * @return string|null
     */
    public function getComment2(): ?string
    {
        return $this->comment2;
    }

    /**
     * @return float|null
     */
    public function getDiscount(): ?float
    {
        return $this->discount;
    }

    /**
     * @return float|null
     */
    public function getUplift(): ?float
    {
        return $this->uplift;
    }

    /**
     * @return string|null
     */
    public function getPromotionId(): ?string
    {
        return $this->promotionId;
    }

    /**
     * @return string|null
     */
    public function getCoterminosityDate(): ?string
    {
        return $this->coterminosityDate;
    }

    /**
     * @return string|null
     */
    public function getCoterminositySubscriptionRef(): ?string
    {
        return $this->coterminositySubscriptionRef;
    }

    /**
     * @return string|null
     */
    public function getSku(): ?string
    {
        return $this->sku;
    }

    /**
     * @return string|null
     */
    public function getBundleArrowSphereSku(): ?string
    {
        return $this->bundleArrowSphereSku;
    }

    /**
     * @return string|null
     */
    public function getBundleUuid(): ?string
    {
        return $this->bundleUuid;
    }
}
