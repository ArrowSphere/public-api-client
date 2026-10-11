<?php

namespace ArrowSphere\PublicApiClient\Campaigns\Entities\LandingPage;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

class LandingPageFeatureItem extends AbstractEntity
{
    public const COLUMN_TITLE = 'title';
    public const COLUMN_DESCRIPTION = 'description';
    public const COLUMN_ICON = 'icon';
    public const COLUMN_SIZE = 'size';
    public const COLUMN_BUTTON_TEXT = 'buttonText';
    public const COLUMN_BUTTON_URL = 'buttonUrl';

    public const DEFAULT_VALUE_TITLE = '';
    public const DEFAULT_VALUE_DESCRIPTION = '';
    public const DEFAULT_VALUE_ICON = '';
    public const DEFAULT_VALUE_SIZE = 4;
    public const DEFAULT_VALUE_BUTTON_TEXT = '';
    public const DEFAULT_VALUE_BUTTON_URL = '';

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
     * @var string
     */
    #[Property(name: self::COLUMN_ICON)]
    protected string $icon = self::DEFAULT_VALUE_ICON;

    /**
     * @var int
     */
    #[Property(name: self::COLUMN_SIZE, type: 'int')]
    protected int $size = self::DEFAULT_VALUE_SIZE;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_BUTTON_TEXT)]
    protected string $buttonText = self::DEFAULT_VALUE_BUTTON_TEXT;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_BUTTON_URL)]
    protected string $buttonUrl = self::DEFAULT_VALUE_BUTTON_URL;

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
     * @return string
     */
    public function getIcon(): string
    {
        return $this->icon;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * @return string
     */
    public function getButtonText(): string
    {
        return $this->buttonText;
    }

    /**
     * @return string
     */
    public function getButtonUrl(): string
    {
        return $this->buttonUrl;
    }
}
