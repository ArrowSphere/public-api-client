<?php

namespace ArrowSphere\PublicApiClient\Billing\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

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

    protected const VALIDATION_RULES = parent::VALIDATION_RULES + [
        self::COLUMN_REFERENCE => 'string|required',
        self::COLUMN_SEQUENCE => 'string|present|nullable',
        self::COLUMN_BILLING_GROUP => 'string|required',
        self::COLUMN_BILLING_STRATEGY => 'string|present|nullable',
        self::COLUMN_VENDOR_NAME => 'string|present|nullable',
        self::COLUMN_PROGRAM_CODE => 'string|present|nullable',
        self::COLUMN_CLASSIFICATION => 'string|present|nullable',
        self::COLUMN_REPORT_PERIOD => 'string|required',
        self::COLUMN_MARKETPLACE => 'string|required',
        self::COLUMN_ISSUE_DATE => 'string|present|nullable',
        self::COLUMN_FROM => 'array|required',
        self::COLUMN_TO => 'array|required',
        self::COLUMN_CURRENCY => 'string|required',
        self::COLUMN_PRICES => 'array|required',
        self::COLUMN_DESCRIPTION => 'string|present|nullable',
        self::COLUMN_STATUS => 'array|nullable',
    ];

    /**
     * @var string
     */
    private $reference;

    /**
     * @var string|null
     */
    private $sequence;

    /**
     * @var string
     */
    private $billingGroup;

    /**
     * @var string|null
     */
    private $billingStrategy;

    /**
     * @var string|null
     */
    private $vendorName;

    /**
     * @var string|null
     */
    private $programCode;

    /**
     * @var string|null
     */
    private $classification;

    /**
     * @var string
     */
    private $reportPeriod;

    /**
     * @var string
     */
    private $marketplace;

    /**
     * @var string|null
     */
    private $issueDate;

    /**
     * @var Identity
     */
    private $from;

    /**
     * @var Identity
     */
    private $to;

    /**
     * @var string
     */
    private $currency;

    /**
     * @var Prices
     */
    private $prices;

    /**
     * @var string|null
     */
    private $description;

    /**
     * @var StatementStatus|null
     */
    private $status;

    /**
     * Statement constructor.
     *
     * @param array $data
     *
     * @throws EntityValidationException
     * @throws \ReflectionException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->reference = $data[self::COLUMN_REFERENCE];
        $this->sequence = $data[self::COLUMN_SEQUENCE];
        $this->billingGroup = $data[self::COLUMN_BILLING_GROUP];
        $this->billingStrategy = $data[self::COLUMN_BILLING_STRATEGY];
        $this->vendorName = $data[self::COLUMN_VENDOR_NAME];
        $this->programCode = $data[self::COLUMN_PROGRAM_CODE];
        $this->classification = $data[self::COLUMN_CLASSIFICATION];
        $this->reportPeriod = $data[self::COLUMN_REPORT_PERIOD];
        $this->marketplace = $data[self::COLUMN_MARKETPLACE];
        $this->issueDate = $data[self::COLUMN_ISSUE_DATE];
        $this->from = new Identity($data[self::COLUMN_FROM]);
        $this->to = new Identity($data[self::COLUMN_TO]);
        $this->currency = $data[self::COLUMN_CURRENCY];
        $this->prices = new Prices($data[self::COLUMN_PRICES]);
        $this->description = $data[self::COLUMN_DESCRIPTION];
        $this->status = isset($data[self::COLUMN_STATUS]) ? new StatementStatus($data[self::COLUMN_STATUS]) : null;
    }

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

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        $status = $this->getStatus();

        return [
            self::COLUMN_REFERENCE => $this->getReference(),
            self::COLUMN_SEQUENCE => $this->getSequence(),
            self::COLUMN_BILLING_GROUP => $this->getBillingGroup(),
            self::COLUMN_BILLING_STRATEGY => $this->getBillingStrategy(),
            self::COLUMN_VENDOR_NAME => $this->getVendorName(),
            self::COLUMN_PROGRAM_CODE => $this->getProgramCode(),
            self::COLUMN_CLASSIFICATION => $this->getClassification(),
            self::COLUMN_REPORT_PERIOD => $this->getReportPeriod(),
            self::COLUMN_MARKETPLACE => $this->getMarketplace(),
            self::COLUMN_ISSUE_DATE => $this->getIssueDate(),
            self::COLUMN_FROM => $this->getFrom()->jsonSerialize(),
            self::COLUMN_TO => $this->getTo()->jsonSerialize(),
            self::COLUMN_CURRENCY => $this->getCurrency(),
            self::COLUMN_PRICES => $this->getPrices()->jsonSerialize(),
            self::COLUMN_DESCRIPTION => $this->getDescription(),
            self::COLUMN_STATUS => $status === null ? null : $status->jsonSerialize(),
        ];
    }
}
