<?php

namespace ArrowSphere\PublicApiClient\Campaigns\Entities\LandingPage;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

class LandingPageMarketingFeature extends AbstractEntity
{
    public const COLUMN_DESCRIPTION = 'description';
    public const COLUMN_TITLE = 'title';
    public const COLUMN_ITEMS = 'items';

    public const DEFAULT_VALUE_DESCRIPTION = '';
    public const DEFAULT_VALUE_TITLE = '';

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_TITLE)]
    protected string $title = self::DEFAULT_VALUE_TITLE;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_DESCRIPTION)]
    protected string $description = self::DEFAULT_VALUE_DESCRIPTION;

    /**
     * @var LandingPageMarketingFeatureItem[]
     */
    #[Property(name: self::COLUMN_ITEMS, type: LandingPageMarketingFeatureItem::class, isArray: true)]
    protected array $items = [];

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
