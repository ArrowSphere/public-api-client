<?php

namespace ArrowSphere\PublicApiClient\Campaigns\Entities;

use ArrowSphere\PublicApiClient\Campaigns\Entities\Asset\Asset;
use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Exception\EntitiesException;
use ArrowSphere\PublicApiClient\Entities\Property;

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
    public const COLUMN_DOWNLOAD_URLS = 'downloadUrls';
    public const KEY_ASSETS = 'assets';

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
     * @var Banner
     */
    #[Property(name: self::COLUMN_BANNER, type: Banner::class, required: true)]
    protected Banner $banner;

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
     * @var LandingPageV2
     */
    #[Property(name: self::COLUMN_LANDING_PAGE, type: LandingPageV2::class, required: true)]
    protected LandingPageV2 $landingPage;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_NAME)]
    protected string $name = self::DEFAULT_VALUE_NAME;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_REFERENCE)]
    protected string $reference = self::DEFAULT_VALUE_REFERENCE;

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
     * @var Asset[] The assets of the nested downloadUrls field, hydrated by the constructor
     */
    protected array $downloadUrlsAssets = [];

    /**
     * CampaignV2 constructor.
     *
     * @param array $data
     *
     * @throws EntitiesException
     */
    public function __construct(array $data)
    {
        // A missing or empty banner, landing page or rules gets an instance with its default values, as an empty array would be considered as missing
        if (empty($data[self::COLUMN_BANNER])) {
            $data[self::COLUMN_BANNER] = new Banner([]);
        }

        if (empty($data[self::COLUMN_LANDING_PAGE])) {
            $data[self::COLUMN_LANDING_PAGE] = new LandingPageV2([]);
        }

        if (empty($data[self::COLUMN_RULES])) {
            $data[self::COLUMN_RULES] = new Rules([]);
        }

        parent::__construct($data);

        $this->downloadUrlsAssets = array_map(static function (array $asset) {
            return new Asset($asset);
        }, $data[self::COLUMN_DOWNLOAD_URLS][self::KEY_ASSETS] ?? []);
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
     * @return Asset[]
     */
    public function getDownloadUrlsAssets(): array
    {
        return $this->downloadUrlsAssets;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return parent::jsonSerialize() + [
            self::COLUMN_DOWNLOAD_URLS => [self::KEY_ASSETS => $this->getDownloadUrlsAssets()],
        ];
    }
}
