<?php

namespace ArrowSphere\PublicApiClient\Orders\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;

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
     * @var string order reference ID
     */
    protected string $reference;

    /**
     * @var string Order status
     */
    protected string $status;

    /**
     * @var string Date the current status was updated
     */
    protected string $dateStatus;

    /**
     * @var string Date the order was created
     */
    protected string $dateCreation;

    /**
     * @var string Arrow order reference
     */
    protected string $orderReference;

    /**
     * @var string|null
     */
    protected ?string $createdBy;

    /**
     * @var string|null
     */
    protected ?string $createdByImpersonator;

    /**
     * @var float
     */
    protected float $commitmentAmountTotal;

    /**
     * @var Partner
     */
    protected Partner $partner;

    /**
     * @var Reference
     */
    protected Reference $customer;

    /**
     * @var string|null PO number
     */
    protected ?string $poNumber;

    /**
     * @var \ArrowSphere\PublicApiClient\Orders\Entities\OrdersProduct[]
     */
    protected array $products;

    /**
     * @var ExtraInformation|null
     */
    private ?ExtraInformation $extraInformation;

    /**
     * @var string Date chosen by the user to define when the order will be provisioned
     */
    private string $scheduledDate;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->reference = $data[self::COLUMN_REFERENCE];
        $this->status = $data[self::COLUMN_STATUS];
        $this->dateStatus = $data[self::COLUMN_DATE_STATUS];
        $this->dateCreation = $data[self::COLUMN_DATE_CREATION];
        $this->orderReference = $data[self::COLUMN_ORDER_REFERENCE];
        $this->partner = new Partner($data[self::COLUMN_PARTNER]);
        $this->customer = new Reference($data[self::COLUMN_CUSTOMER]);
        $this->poNumber = $data[self::COLUMN_PO_NUMBER] ?? '';
        $this->products = array_map(static fn (array $product) => new OrdersProduct($product), $data[self::COLUMN_PRODUCTS]);
        $this->createdBy = $data[self::COLUMN_CREATED_BY] ?? null;
        $this->createdByImpersonator = $data[self::COLUMN_CREATED_BY_IMPERSONATOR] ?? null;
        $this->commitmentAmountTotal = $data[self::COLUMN_COMMITMENT_AMOUNT_TOTAL];
        $this->extraInformation = isset($data[self::COLUMN_EXTRA_INFORMATION]) ? new ExtraInformation($data[self::COLUMN_EXTRA_INFORMATION]) : null;
        $this->scheduledDate = $data[self::COLUMN_SCHEDULED_DATE] ?? '';
    }

    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_REFERENCE         => $this->reference,
            self::COLUMN_STATUS            => $this->status,
            self::COLUMN_DATE_STATUS       => $this->dateStatus,
            self::COLUMN_DATE_CREATION     => $this->dateCreation,
            self::COLUMN_ORDER_REFERENCE   => $this->orderReference,
            self::COLUMN_PARTNER           => $this->partner->jsonSerialize(),
            self::COLUMN_CUSTOMER          => $this->customer->jsonSerialize(),
            self::COLUMN_PO_NUMBER         => $this->poNumber,
            self::COLUMN_PRODUCTS          => array_map(static fn (OrdersProduct $product) => $product->jsonSerialize(), $this->products),
            self::COLUMN_EXTRA_INFORMATION => $this->extraInformation?->jsonSerialize(),
            self::COLUMN_SCHEDULED_DATE    => $this->scheduledDate,
        ];
    }

    public function getReference(): string
    {
        return $this->reference;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getDateStatus(): string
    {
        return $this->dateStatus;
    }

    public function getDateCreation(): string
    {
        return $this->dateCreation;
    }

    public function getOrderReference(): string
    {
        return $this->orderReference;
    }

    public function getPartner(): Partner
    {
        return $this->partner;
    }

    public function getCustomer(): Reference
    {
        return $this->customer;
    }

    public function getPoNumber(): ?string
    {
        return $this->poNumber;
    }

    /**
     * @return \ArrowSphere\PublicApiClient\Orders\Entities\OrdersProduct[]
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    public function getCreatedBy(): ?string
    {
        return $this->createdBy;
    }

    public function getCreatedByImpersonator(): ?string
    {
        return $this->createdByImpersonator;
    }

    public function getCommitmentAmountTotal(): float
    {
        return $this->commitmentAmountTotal;
    }

    public function getExtraInformation(): ?ExtraInformation
    {
        return $this->extraInformation;
    }

    public function getScheduledDate(): ?string
    {
        return $this->scheduledDate;
    }
}
