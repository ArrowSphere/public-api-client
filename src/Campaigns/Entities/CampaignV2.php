<?php

namespace ArrowSphere\PublicApiClient\Campaigns\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

class CampaignV2 extends AbstractEntity
{
    public const COLUMN_BANNER = 'banner';
    public const COLUMN_CATEGORY = 'category';
    public const COLUMN_CREATED_AT = 'createdAt';
    public const COLUMN_DELETED_AT = 'deletedAt';
    public const COLUMN_END_DATE = 'endDate';
    public const COLUMN_IS_ACTIVATED = 'isActivated';
    public const COLUMN_LANDING_PAGE = 'landingPage';
    public const COLUMN_NAME = 'name';
    public const COLUMN_REFERENCE = 'reference';
    public const COLUMN_RULES = 'rules';
    public const COLUMN_START_DATE = 'startDate';
    public const COLUMN_UPDATED_AT = 'updatedAt';
    public const COLUMN_WEIGHT = 'weight';

    public const DEFAULT_VALUE_CATEGORY = 'BANNER';
    public const DEFAULT_VALUE_CREATED_AT = null;
    public const DEFAULT_VALUE_DELETED_AT = null;
    public const DEFAULT_VALUE_END_DATE = null;
    public const DEFAULT_VALUE_NAME = '';
    public const DEFAULT_VALUE_REFERENCE = '';
    public const DEFAULT_VALUE_START_DATE = null;
    public const DEFAULT_VALUE_UPDATED_AT = null;
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
     * @var bool
     */
    private $isActivated;

    /**
     * @var string
     */
    private $createdAt;

    /**
     * @var string|null
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
     * @var Banner
     */
    private $banner;

    /**
     * @var LandingPageV2
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

        $this->banner = new Banner($data[self::COLUMN_BANNER] ?? []);
        $this->category = $data[self::COLUMN_CATEGORY] ?? self::DEFAULT_VALUE_CATEGORY;
        $this->isActivated = $data[self::COLUMN_IS_ACTIVATED] ?? false;
        $this->createdAt = $data[self::COLUMN_CREATED_AT] ?? self::DEFAULT_VALUE_CREATED_AT;
        $this->deletedAt = $data[self::COLUMN_DELETED_AT] ?? self::DEFAULT_VALUE_DELETED_AT;
        $this->endDate = $data[self::COLUMN_END_DATE] ?? self::DEFAULT_VALUE_END_DATE;
        $this->landingPage = new LandingPageV2($data[self::COLUMN_LANDING_PAGE] ?? []);
        $this->name = $data[self::COLUMN_NAME] ?? self::DEFAULT_VALUE_NAME ;
        $this->reference = $data[self::COLUMN_REFERENCE] ?? self::DEFAULT_VALUE_REFERENCE;
        $this->rules = new Rules($data[self::COLUMN_RULES] ?? []);
        $this->startDate = $data[self::COLUMN_START_DATE] ?? self::DEFAULT_VALUE_START_DATE;
        $this->updatedAt = $data[self::COLUMN_UPDATED_AT] ?? self::DEFAULT_VALUE_UPDATED_AT;
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
     * @return bool
     */
    public function getIsActivated(): bool
    {
        return $this->isActivated;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @return string|null
     */
    public function getUpdatedAt(): ?string
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
     * @return Banner
     */
    public function getBanner(): Banner
    {
        return $this->banner;
    }

    /**
     * @return LandingPageV2
     */
    public function getLandingPage(): LandingPageV2
    {
        return $this->landingPage;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_BANNER       => $this->getBanner(),
            self::COLUMN_CATEGORY     => $this->getCategory(),
            self::COLUMN_IS_ACTIVATED => $this->getIsActivated(),
            self::COLUMN_CREATED_AT   => $this->getCreatedAt(),
            self::COLUMN_DELETED_AT   => $this->getDeletedAt(),
            self::COLUMN_END_DATE     => $this->getEndDate(),
            self::COLUMN_LANDING_PAGE => $this->getLandingPage(),
            self::COLUMN_NAME         => $this->getName(),
            self::COLUMN_REFERENCE    => $this->getReference(),
            self::COLUMN_RULES        => $this->getRules(),
            self::COLUMN_START_DATE   => $this->getStartDate(),
            self::COLUMN_UPDATED_AT   => $this->getUpdatedAt(),
            self::COLUMN_WEIGHT       => $this->getWeight(),
        ];
    }
}
