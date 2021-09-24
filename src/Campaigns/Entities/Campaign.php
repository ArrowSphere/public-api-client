<?php

namespace ArrowSphere\PublicApiClient\Campaigns\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

class Campaign extends AbstractEntity
{
    public const COLUMN_BANNERS = 'banners';
    public const COLUMN_CATEGORY = 'category';
    public const COLUMN_CREATEDAT = 'createdAt';
    public const COLUMN_DELETEDAT = 'deletedAt';
    public const COLUMN_ENDDATE = 'endDate';
    public const COLUMN_LANDINGPAGE = 'landingPage';
    public const COLUMN_NAME = 'name';
    public const COLUMN_REFERENCE = 'reference';
    public const COLUMN_RULES = 'rules';
    public const COLUMN_STARTDATE = 'startDate';
    public const COLUMN_UPDATEDAT = 'updatedAt';
    public const COLUMN_WEIGHT = 'weight';

    public const DEFAULT_VALUE_CATEGORY = 'BANNER';
    public const DEFAULT_VALUE_DELETEDAT = null;
    public const DEFAULT_VALUE_ENDDATE = null;
    public const DEFAULT_VALUE_STARTDATE = null;
    public const DEFAULT_VALUE_UPDATEDAT = null;
    public const DEFAULT_VALUE_WEIGHT = 1;

    /**
     * @var string
     */
    private $reference;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $category;

    /**
     * @var string
     */
    private $createdAt;

    /**
     * @var string
     */
    private $updatedAt;

    /**
     * @var string|null
     */
    private $deletedAt;

    /**
     * @var Rules
     */
    private $rules;

    /**
     * @var int
     */
    private $weight;

    /**
     * @var string|null
     */
    private $startDate;

    /**
     * @var string|null
     */
    private $endDate;

    /**
     * @var Banner[]
     */
    private $banners;

    /**
     * @var LandingPage
     */
    private $landingPage;

    /**
     * Statement constructor.
     *
     * @param array $data
     *
     * @throws EntityValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->banners = $data[self::COLUMN_BANNERS];
        $this->category = $data[self::COLUMN_CATEGORY] ?? self::DEFAULT_VALUE_CATEGORY;
        $this->createdAt = $data[self::COLUMN_CREATEDAT];
        $this->deletedAt = $data[self::COLUMN_DELETEDAT] ?? self::DEFAULT_VALUE_DELETEDAT;
        $this->endDate = $data[self::COLUMN_ENDDATE] ?? self::DEFAULT_VALUE_ENDDATE;
        $this->landingPage = new LandingPage($data[self::COLUMN_LANDINGPAGE]);
        $this->name = $data[self::COLUMN_NAME];
        $this->reference = $data[self::COLUMN_REFERENCE];
        $this->rules = new Rules($data[self::COLUMN_RULES] ?? []);
        $this->startDate = $data[self::COLUMN_STARTDATE] ?? self::DEFAULT_VALUE_STARTDATE;
        $this->updatedAt = $data[self::COLUMN_UPDATEDAT] ?? self::DEFAULT_VALUE_UPDATEDAT;
        $this->weight = $data[self::COLUMN_WEIGHT] ?? self::DEFAULT_VALUE_WEIGHT;
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    /**
     * @return string|null
     */
    public function getDeletedAt(): ?string
    {
        return $this->deletedAt;
    }

    /**
     * @return Rules
     */
    public function getRules(): Rules
    {
        return $this->rules;
    }

    /**
     * @return int
     */
    public function getWeight(): int
    {
        return $this->weight;
    }

    /**
     * @return string|null
     */
    public function getStartDate(): ?string
    {
        return $this->startDate;
    }

    /**
     * @return string|null
     */
    public function getEndDate(): ?string
    {
        return $this->endDate;
    }

    /**
     * @return Banner[]
     */
    public function getBanners(): array
    {
        return $this->banners;
    }

    /**
     * @return LandingPage
     */
    public function getLandingPage(): LandingPage
    {
        return $this->landingPage;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_BANNERS     => $this->getBanners(),
            self::COLUMN_CATEGORY    => $this->getCategory(),
            self::COLUMN_CREATEDAT   => $this->getCreatedAt(),
            self::COLUMN_DELETEDAT   => $this->getDeletedAt(),
            self::COLUMN_ENDDATE     => $this->getEndDate(),
            self::COLUMN_LANDINGPAGE => $this->getLandingPage(),
            self::COLUMN_NAME        => $this->getName(),
            self::COLUMN_REFERENCE   => $this->getReference(),
            self::COLUMN_RULES       => $this->getRules(),
            self::COLUMN_STARTDATE   => $this->getStartDate(),
            self::COLUMN_UPDATEDAT   => $this->getUpdatedAt(),
            self::COLUMN_WEIGHT      => $this->getWeight(),
        ];
    }
}
