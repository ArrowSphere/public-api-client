<?php

namespace ArrowSphere\PublicApiClient\Subscription\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Subscription\Entities\SubscriptionDetails;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

class Subscription extends AbstractEntity
{
    public const COLUMN_NAME = 'name';

    public const COLUMN_REFERENCE = 'reference';

    public const COLUMN_STATUS = 'status';

    public const COLUMN_DATE_DEMAND = 'dateDemand';

    public const COLUMN_DATE_VALIDATION = 'dateValidation';

    public const COLUMN_Date_End = 'dateEnd';

    public const COLUMN_DETAILS = 'details';

    protected const VALIDATION_RULES = [
        self::COLUMN_NAME => 'required',
    ];

    /** @var string */
    protected $name;

    /** @var SubscriptionDetails[] */
    protected $details;

    /** @var string|null */
    protected $reference;

    /** @var string|null */
    protected $status;

    /** @var string|null */
    protected $dateDemand;

    /** @var string|null */
    protected $dateValidation;

    /** @var string|null */
    protected $dateEnd;

    /**
     * @param array $data
     *
     * @throws EntityValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->name = $data[self::COLUMN_NAME];
        $this->reference = $data[self::COLUMN_REFERENCE] ?? null;
        $this->status = $data[self::COLUMN_STATUS] ?? null;
        $this->dateDemand = $data[self::COLUMN_DATE_DEMAND] ?? null;
        $this->dateValidation = $data[self::COLUMN_DATE_VALIDATION] ?? null;
        $this->dateEnd = $data[self::COLUMN_Date_End] ?? null;
        $this->details = new SubscriptionDetails($data[self::COLUMN_DETAILS] ?? []);
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_NAME            => $this->name,
            self::COLUMN_REFERENCE       => $this->reference,
            self::COLUMN_STATUS          => $this->status,
            self::COLUMN_DATE_DEMAND     => $this->dateDemand,
            self::COLUMN_DATE_VALIDATION => $this->dateValidation,
            self::COLUMN_Date_End        => $this->dateEnd,
            self::COLUMN_DETAILS         => $this->details->jsonSerialize(),
        ];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Subscription
     */
    public function setName(string $name): Subscription
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getReference(): ?string
    {
        return $this->reference;
    }

    /**
     * @param string|null $reference
     *
     * @return Subscription
     */
    public function setReference(?string $reference): Subscription
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     *
     * @return Subscription
     */
    public function setStatus(?string $status): Subscription
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDateDemand(): ?string
    {
        return $this->dateDemand;
    }

    /**
     * @param string|null $dateDemand
     *
     * @return Subscription
     */
    public function setDateDemand(?string $dateDemand): Subscription
    {
        $this->dateDemand = $dateDemand;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDateValidation(): ?string
    {
        return $this->dateValidation;
    }

    /**
     * @param string|null $dateValidation
     *
     * @return Subscription
     */
    public function setDateValidation(?string $dateValidation): Subscription
    {
        $this->dateValidation = $dateValidation;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * @param string|null $dateEnd
     *
     * @return Subscription
     */
    public function setDateEnd(?string $dateEnd): Subscription
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    /**
     * @return array
     */
    public function getDetails(): array
    {
        return $this->details;
    }

    /**
     * @param array $details
     *
     * @return Subscription
     */
    public function setDetails(array $details): Subscription
    {
        $this->details = $details;

        return $this;
    }
}
