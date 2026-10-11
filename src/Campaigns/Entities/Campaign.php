<?php

namespace ArrowSphere\PublicApiClient\Campaigns\Entities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Exception\EntitiesException;
use ArrowSphere\PublicApiClient\Entities\Property;

class Campaign extends AbstractEntity
{
    public const COLUMN_BANNERS = 'banners';
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
    public const DEFAULT_VALUE_DELETED_AT = null;
    public const DEFAULT_VALUE_END_DATE = null;
    public const DEFAULT_VALUE_START_DATE = null;
    public const DEFAULT_VALUE_UPDATED_AT = null;
    public const DEFAULT_VALUE_WEIGHT = 1;

    /**
     * @var Banner[]
     */
    #[Property(name: self::COLUMN_BANNERS, type: Banner::class, isArray: true)]
    protected array $banners = [];

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_CATEGORY)]
    protected string $category = self::DEFAULT_VALUE_CATEGORY;

    /**
     * @var bool
     */
    #[Property(name: self::COLUMN_IS_ACTIVATED, type: 'bool')]
    protected bool $isActivated = false;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_CREATED_AT, required: true)]
    protected string $createdAt;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_DELETED_AT, serializeNull: true)]
    protected ?string $deletedAt = self::DEFAULT_VALUE_DELETED_AT;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_END_DATE, serializeNull: true)]
    protected ?string $endDate = self::DEFAULT_VALUE_END_DATE;

    /**
     * @var LandingPage
     */
    #[Property(name: self::COLUMN_LANDING_PAGE, type: LandingPage::class, required: true)]
    protected LandingPage $landingPage;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_NAME, required: true)]
    protected string $name;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_REFERENCE, required: true)]
    protected string $reference;

    /**
     * @var Rules
     */
    #[Property(name: self::COLUMN_RULES, type: Rules::class, required: true)]
    protected Rules $rules;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_START_DATE, serializeNull: true)]
    protected ?string $startDate = self::DEFAULT_VALUE_START_DATE;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_UPDATED_AT, serializeNull: true)]
    protected ?string $updatedAt = self::DEFAULT_VALUE_UPDATED_AT;

    /**
     * @var int
     */
    #[Property(name: self::COLUMN_WEIGHT, type: 'int')]
    protected int $weight = self::DEFAULT_VALUE_WEIGHT;

    /**
     * Campaign constructor.
     *
     * @param array $data
     *
     * @throws EntitiesException
     */
    public function __construct(array $data)
    {
        // A missing or empty landing page or rules gets an instance with its default values, as an empty array would be considered as missing
        if (empty($data[self::COLUMN_LANDING_PAGE])) {
            $data[self::COLUMN_LANDING_PAGE] = new LandingPage([]);
        }

        if (empty($data[self::COLUMN_RULES])) {
            $data[self::COLUMN_RULES] = new Rules([]);
        }

        parent::__construct($data);
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
}
