<?php

namespace ArrowSphere\PublicApiClient\Billing\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

class Statement extends AbstractEntity
{
    public const COLUMN_REFERENCE = 'reference';
    public const COLUMN_BILLING_GROUP = 'billingGroup';
    public const COLUMN_VENDOR_NAME = 'vendorName';
    public const COLUMN_CLASSIFICATION = 'classification';
    public const COLUMN_REPORT_PERIOD = 'reportPeriod';
    public const COLUMN_MARKETPLACE = 'marketplace';
    public const COLUMN_ISSUE_DATE = 'issueDate';
    public const COLUMN_FROM = 'from';
    public const COLUMN_TO = 'to';
    public const COLUMN_CURRENCY = 'currency';
    public const COLUMN_PRICES = 'prices';

    protected const VALIDATION_RULES = parent::VALIDATION_RULES + [
        self::COLUMN_REFERENCE => 'string|required',
        self::COLUMN_BILLING_GROUP => 'string|required',
        self::COLUMN_FROM => 'array|required',
        self::COLUMN_TO => 'array|required',
        self::COLUMN_ISSUE_DATE => 'string|present|nullable',
        self::COLUMN_MARKETPLACE => 'string|required',
        self::COLUMN_CURRENCY => 'string|required',
    ];

    /**
     * @var string
     */
    private $reference;

    /**
     * @var string
     */
    private $billingGroup;

    /**
     * @var string
     */
    private $vendorName;

    /**
     * @var string
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
        $this->billingGroup = $data[self::COLUMN_BILLING_GROUP];
        $this->vendorName = $data[self::COLUMN_VENDOR_NAME];
        $this->classification = $data[self::COLUMN_CLASSIFICATION];
        $this->reportPeriod = $data[self::COLUMN_REPORT_PERIOD];
        $this->marketplace = $data[self::COLUMN_MARKETPLACE];
        $this->issueDate = $data[self::COLUMN_ISSUE_DATE];
        $this->from = new Identity($data[self::COLUMN_FROM]);
        $this->to = new Identity($data[self::COLUMN_TO]);
        $this->currency = $data[self::COLUMN_CURRENCY];
        $this->prices = new Prices($data[self::COLUMN_PRICES]);
    }

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
    public function getBillingGroup(): string
    {
        return $this->billingGroup;
    }

    /**
     * @return string
     */
    public function getVendorName(): string
    {
        return $this->vendorName;
    }

    /**
     * @return string
     */
    public function getClassification(): string
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
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_REFERENCE => $this->getReference(),
            self::COLUMN_BILLING_GROUP => $this->getBillingGroup(),
            self::COLUMN_VENDOR_NAME => $this->getVendorName(),
            self::COLUMN_CLASSIFICATION => $this->getClassification(),
            self::COLUMN_REPORT_PERIOD => $this->getReportPeriod(),
            self::COLUMN_MARKETPLACE => $this->getMarketplace(),
            self::COLUMN_ISSUE_DATE => $this->getIssueDate(),
            self::COLUMN_FROM => $this->getFrom()->jsonSerialize(),
            self::COLUMN_TO => $this->getTo()->jsonSerialize(),
            self::COLUMN_CURRENCY => $this->getCurrency(),
            self::COLUMN_PRICES => $this->getPrices()->jsonSerialize(),
        ];
    }
}
