<?php

namespace ArrowSphere\PublicApiClient\Billing\Entities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

class Statement extends AbstractEntity
{
    public const COLUMN_REFERENCE = 'reference';
    public const COLUMN_SEQUENCE = 'sequence';
    public const COLUMN_BILLING_GROUP = 'billingGroup';
    public const COLUMN_BILLING_STRATEGY = 'billingStrategy';
    public const COLUMN_VENDOR_NAME = 'vendorName';
    public const COLUMN_PROGRAM_CODE = 'programCode';
    public const COLUMN_CLASSIFICATION = 'classification';
    public const COLUMN_REPORT_PERIOD = 'reportPeriod';
    public const COLUMN_MARKETPLACE = 'marketplace';
    public const COLUMN_ISSUE_DATE = 'issueDate';
    public const COLUMN_FROM = 'from';
    public const COLUMN_TO = 'to';
    public const COLUMN_CURRENCY = 'currency';
    public const COLUMN_PRICES = 'prices';
    public const COLUMN_DESCRIPTION = 'description';
    public const COLUMN_STATUS = 'status';

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_REFERENCE, required: true)]
    protected string $reference;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_SEQUENCE, serializeNull: true)]
    protected ?string $sequence = null;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_BILLING_GROUP, required: true)]
    protected string $billingGroup;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_BILLING_STRATEGY, serializeNull: true)]
    protected ?string $billingStrategy = null;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_VENDOR_NAME, serializeNull: true)]
    protected ?string $vendorName = null;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_PROGRAM_CODE, serializeNull: true)]
    protected ?string $programCode = null;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_CLASSIFICATION, serializeNull: true)]
    protected ?string $classification = null;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_REPORT_PERIOD, required: true)]
    protected string $reportPeriod;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_MARKETPLACE, required: true)]
    protected string $marketplace;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_ISSUE_DATE, serializeNull: true)]
    protected ?string $issueDate = null;

    /**
     * @var Identity
     */
    #[Property(name: self::COLUMN_FROM, type: Identity::class, required: true)]
    protected Identity $from;

    /**
     * @var Identity
     */
    #[Property(name: self::COLUMN_TO, type: Identity::class, required: true)]
    protected Identity $to;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_CURRENCY, required: true)]
    protected string $currency;

    /**
     * @var Prices
     */
    #[Property(name: self::COLUMN_PRICES, type: Prices::class, required: true)]
    protected Prices $prices;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_DESCRIPTION, serializeNull: true)]
    protected ?string $description = null;

    /**
     * @var StatementStatus|null
     */
    #[Property(name: self::COLUMN_STATUS, type: StatementStatus::class, serializeNull: true)]
    protected ?StatementStatus $status = null;

    /**
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * @return string|null
     */
    public function getSequence(): ?string
    {
        return $this->sequence;
    }

    /**
     * @return string
     */
    public function getBillingGroup(): string
    {
        return $this->billingGroup;
    }

    /**
     * @return string|null
     */
    public function getBillingStrategy(): ?string
    {
        return $this->billingStrategy;
    }

    /**
     * @return string|null
     */
    public function getVendorName(): ?string
    {
        return $this->vendorName;
    }

    /**
     * @return string|null
     */
    public function getProgramCode(): ?string
    {
        return $this->programCode;
    }

    /**
     * @return string|null
     */
    public function getClassification(): ?string
    {
        return $this->classification;
    }

    /**
     * @return string
     */
    public function getReportPeriod(): string
    {
        return $this->reportPeriod;
    }

    /**
     * @return string
     */
    public function getMarketplace(): string
    {
        return $this->marketplace;
    }

    /**
     * @return string|null
     */
    public function getIssueDate(): ?string
    {
        return $this->issueDate;
    }

    /**
     * @return Identity
     */
    public function getFrom(): Identity
    {
        return $this->from;
    }

    /**
     * @return Identity
     */
    public function getTo(): Identity
    {
        return $this->to;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @return Prices
     */
    public function getPrices(): Prices
    {
        return $this->prices;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return StatementStatus
     */
    public function getStatus(): ?StatementStatus
    {
        return $this->status;
    }
}
