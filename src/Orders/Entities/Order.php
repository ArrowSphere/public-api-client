<?php

namespace ArrowSphere\PublicApiClient\Orders\Entities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

class Order extends AbstractEntity
{
    public const COLUMN_REFERENCE = 'reference';

    public const COLUMN_STATUS = 'status';

    public const COLUMN_DATE_STATUS = 'dateStatus';

    public const COLUMN_DATE_CREATION = 'dateCreation';

    public const COLUMN_ORDER_REFERENCE = 'order_reference';

    public const COLUMN_CREATED_BY = 'createdBy';

    public const COLUMN_CREATED_BY_IMPERSONATOR = 'createdByImpersonator';

    public const COLUMN_COMMITMENT_AMOUNT_TOTAL = 'commitmentAmountTotal';

    public const COLUMN_PARTNER = 'partner';

    public const COLUMN_CUSTOMER = 'customer';

    public const COLUMN_PO_NUMBER = 'ponumber';

    public const COLUMN_PRODUCTS = 'products';

    public const COLUMN_EXTRA_INFORMATION = 'extraInformation';

    public const COLUMN_SCHEDULED_DATE = 'scheduledDate';

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_REFERENCE, required: true)]
    protected string $reference;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_STATUS, required: true)]
    protected string $status;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_DATE_STATUS, required: true)]
    protected string $dateStatus;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_DATE_CREATION, required: true)]
    protected string $dateCreation;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_ORDER_REFERENCE, required: true)]
    protected string $orderReference;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_CREATED_BY, serializeNull: true)]
    protected ?string $createdBy = null;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_CREATED_BY_IMPERSONATOR, serializeNull: true)]
    protected ?string $createdByImpersonator = null;

    /**
     * @var float
     */
    #[Property(name: self::COLUMN_COMMITMENT_AMOUNT_TOTAL, type: 'float', required: true)]
    protected float $commitmentAmountTotal;

    /**
     * @var Partner
     */
    #[Property(name: self::COLUMN_PARTNER, type: Partner::class, required: true)]
    protected Partner $partner;

    /**
     * @var Reference
     */
    #[Property(name: self::COLUMN_CUSTOMER, type: Reference::class, required: true)]
    protected Reference $customer;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_PO_NUMBER)]
    protected string $poNumber = '';

    /**
     * @var OrdersProduct[]
     */
    #[Property(name: self::COLUMN_PRODUCTS, type: OrdersProduct::class, isArray: true)]
    protected array $products = [];

    /**
     * @var ExtraInformation|null
     */
    #[Property(name: self::COLUMN_EXTRA_INFORMATION, type: ExtraInformation::class, serializeNull: true)]
    protected ?ExtraInformation $extraInformation = null;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_SCHEDULED_DATE)]
    protected string $scheduledDate = '';

    /**
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getDateStatus(): string
    {
        return $this->dateStatus;
    }

    /**
     * @return string
     */
    public function getDateCreation(): string
    {
        return $this->dateCreation;
    }

    /**
     * @return string
     */
    public function getOrderReference(): string
    {
        return $this->orderReference;
    }

    /**
     * @return Partner
     */
    public function getPartner(): Partner
    {
        return $this->partner;
    }

    /**
     * @return Reference
     */
    public function getCustomer(): Reference
    {
        return $this->customer;
    }

    /**
     * @return string|null
     */
    public function getPoNumber(): ?string
    {
        return $this->poNumber;
    }

    /**
     * @return OrdersProduct[]
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * @return string|null
     */
    public function getCreatedBy(): ?string
    {
        return $this->createdBy;
    }

    /**
     * @return string|null
     */
    public function getCreatedByImpersonator(): ?string
    {
        return $this->createdByImpersonator;
    }

    /**
     * @return float
     */
    public function getCommitmentAmountTotal(): float
    {
        return $this->commitmentAmountTotal;
    }

    /**
     * @return ExtraInformation|null
     */
    public function getExtraInformation(): ?ExtraInformation
    {
        return $this->extraInformation;
    }

    /**
     * @return string|null
     */
    public function getScheduledDate(): ?string
    {
        return $this->scheduledDate;
    }
}
