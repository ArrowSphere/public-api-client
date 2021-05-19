<?php

namespace ArrowSphere\PublicApiClient\Billing\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Billing\Enum\StatementStatusEnum;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

class Statement extends AbstractEntity
{
    public const COLUMN_REFERENCE = 'reference';
    public const COLUMN_STRATEGY = 'strategy';
    public const COLUMN_GROUP = 'group';
    public const COLUMN_STATUS = 'status';
    public const COLUMN_FROM = 'from';
    public const COLUMN_TO = 'to';
    public const COLUMN_CREATION_DATE = 'creationDate';
    public const COLUMN_SUBMISSION_DATE = 'submissionDate';
    public const COLUMN_ISSUE_DATE = 'issueDate';
    public const COLUMN_MARKETPLACE = 'marketplace';
    public const COLUMN_VENDOR_CURRENCY = 'vendorCurrency';
    public const COLUMN_VENDOR_RESELLER_TOTAL_BUY_PRICE = 'vendorResellerTotalBuyPrice';
    public const COLUMN_VENDOR_END_CUSTOMER_TOTAL_BUY_PRICE = 'vendorEndCustomerTotalBuyPrice';
    public const COLUMN_COUNTRY_CURRENCY = 'countryCurrency';
    public const COLUMN_COUNTRY_RESELLER_TOTAL_BUY_PRICE = 'countryResellerTotalBuyPrice';
    public const COLUMN_COUNTRY_END_CUSTOMER_TOTAL_BUY_PRICE = 'countryEndCustomerTotalBuyPrice';

    protected const VALIDATION_RULES = parent::VALIDATION_RULES + [
        self::COLUMN_REFERENCE => 'string|required',
        self::COLUMN_STRATEGY => 'string|required',
        self::COLUMN_GROUP => 'string|required',
        self::COLUMN_STATUS => 'string|required',
        self::COLUMN_FROM => 'array|required',
        self::COLUMN_TO => 'array|required',
        self::COLUMN_CREATION_DATE => 'string|required',
        self::COLUMN_SUBMISSION_DATE => 'string|present|nullable',
        self::COLUMN_ISSUE_DATE => 'string|present|nullable',
        self::COLUMN_MARKETPLACE => 'string|required',
        self::COLUMN_VENDOR_CURRENCY => 'string|required',
        self::COLUMN_VENDOR_RESELLER_TOTAL_BUY_PRICE => 'numeric|required',
        self::COLUMN_VENDOR_END_CUSTOMER_TOTAL_BUY_PRICE => 'numeric|required',
        self::COLUMN_COUNTRY_CURRENCY => 'string|required',
        self::COLUMN_COUNTRY_RESELLER_TOTAL_BUY_PRICE => 'numeric|required',
        self::COLUMN_COUNTRY_END_CUSTOMER_TOTAL_BUY_PRICE => 'numeric|required',
    ];

    /**
     * @var string
     */
    private $reference;

    /**
     * @var string
     */
    private $strategy;

    /**
     * @var string
     */
    private $group;

    /**
     * @var string
     */
    private $status;

    /**
     * @var Identity
     */
    private $from;

    /**
     * @var Identity[]
     */
    private $to;

    /**
     * @var string
     */
    private $creationDate;

    /**
     * @var string|null
     */
    private $submissionDate;

    /**
     * @var string|null
     */
    private $issueDate;

    /**
     * @var string
     */
    private $marketplace;

    /**
     * @var string
     */
    private $vendorCurrency;

    /**
     * @var float
     */
    private $vendorResellerTotalBuyPrice;

    /**
     * @var float
     */
    private $vendorEndCustomerTotalBuyPrice;

    /**
     * @var string
     */
    private $countryCurrency;

    /**
     * @var float
     */
    private $countryResellerTotalBuyPrice;

    /**
     * @var float
     */
    private $countryEndCustomerTotalBuyPrice;

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

        if (! StatementStatusEnum::isValidValue($data[self::COLUMN_STATUS])) {
            throw new EntityValidationException('Status: ' . $data[self::COLUMN_STATUS] . ' not supported');
        }

        $this->reference = $data[self::COLUMN_REFERENCE];
        $this->strategy = $data[self::COLUMN_STRATEGY];
        $this->group = $data[self::COLUMN_GROUP];
        $this->status = $data[self::COLUMN_STATUS];
        $this->from = new Identity($data[self::COLUMN_FROM]);
        $this->to = array_map(static function ($to) {
            return new Identity($to);
        }, $data[self::COLUMN_TO]);
        $this->creationDate = $data[self::COLUMN_CREATION_DATE];
        $this->submissionDate = $data[self::COLUMN_SUBMISSION_DATE];
        $this->issueDate = $data[self::COLUMN_ISSUE_DATE];
        $this->marketplace = $data[self::COLUMN_MARKETPLACE];
        $this->vendorCurrency = $data[self::COLUMN_VENDOR_CURRENCY];
        $this->vendorResellerTotalBuyPrice = $data[self::COLUMN_VENDOR_RESELLER_TOTAL_BUY_PRICE];
        $this->vendorEndCustomerTotalBuyPrice = $data[self::COLUMN_VENDOR_END_CUSTOMER_TOTAL_BUY_PRICE];
        $this->countryCurrency = $data[self::COLUMN_COUNTRY_CURRENCY];
        $this->countryResellerTotalBuyPrice = $data[self::COLUMN_COUNTRY_RESELLER_TOTAL_BUY_PRICE];
        $this->countryEndCustomerTotalBuyPrice = $data[self::COLUMN_COUNTRY_END_CUSTOMER_TOTAL_BUY_PRICE];
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
    public function getStrategy(): string
    {
        return $this->strategy;
    }

    /**
     * @return string
     */
    public function getGroup(): string
    {
        return $this->group;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return Identity
     */
    public function getFrom(): Identity
    {
        return $this->from;
    }

    /**
     * @return Identity[]
     */
    public function getTo(): array
    {
        return $this->to;
    }

    /**
     * @return string
     */
    public function getVendorCurrency(): string
    {
        return $this->vendorCurrency;
    }

    /**
     * @return float
     */
    public function getVendorResellerTotalBuyPrice(): float
    {
        return $this->vendorResellerTotalBuyPrice;
    }

    /**
     * @return float
     */
    public function getVendorEndCustomerTotalBuyPrice(): float
    {
        return $this->vendorEndCustomerTotalBuyPrice;
    }

    /**
     * @return string
     */
    public function getCountryCurrency(): string
    {
        return $this->countryCurrency;
    }

    /**
     * @return float
     */
    public function getCountryResellerTotalBuyPrice(): float
    {
        return $this->countryResellerTotalBuyPrice;
    }

    /**
     * @return float
     */
    public function getCountryEndCustomerTotalBuyPrice(): float
    {
        return $this->countryEndCustomerTotalBuyPrice;
    }

    /**
     * @return string
     */
    public function getCreationDate(): string
    {
        return $this->creationDate;
    }

    /**
     * @return string|null
     */
    public function getSubmissionDate(): ?string
    {
        return $this->submissionDate;
    }

    /**
     * @return string|null
     */
    public function getIssueDate(): ?string
    {
        return $this->issueDate;
    }

    /**
     * @return string
     */
    public function getMarketplace(): string
    {
        return $this->marketplace;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_REFERENCE => $this->getReference(),
            self::COLUMN_STRATEGY => $this->getStrategy(),
            self::COLUMN_GROUP => $this->getGroup(),
            self::COLUMN_STATUS => $this->getStatus(),
            self::COLUMN_FROM => $this->getFrom()->jsonSerialize(),
            self::COLUMN_TO => array_map(static function (Identity $to) {
                return $to->jsonSerialize();
            }, $this->getTo()),
            self::COLUMN_CREATION_DATE => $this->getCreationDate(),
            self::COLUMN_SUBMISSION_DATE => $this->getSubmissionDate(),
            self::COLUMN_ISSUE_DATE => $this->getIssueDate(),
            self::COLUMN_MARKETPLACE => $this->getMarketplace(),
            self::COLUMN_VENDOR_CURRENCY => $this->getVendorCurrency(),
            self::COLUMN_VENDOR_RESELLER_TOTAL_BUY_PRICE => $this->getVendorResellerTotalBuyPrice(),
            self::COLUMN_VENDOR_END_CUSTOMER_TOTAL_BUY_PRICE => $this->getVendorEndCustomerTotalBuyPrice(),
            self::COLUMN_COUNTRY_CURRENCY => $this->getCountryCurrency(),
            self::COLUMN_COUNTRY_RESELLER_TOTAL_BUY_PRICE => $this->getCountryResellerTotalBuyPrice(),
            self::COLUMN_COUNTRY_END_CUSTOMER_TOTAL_BUY_PRICE => $this->getCountryENdCustomerTotalBuyPrice(),
        ];
    }
}
