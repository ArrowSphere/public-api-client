<?php

namespace ArrowSphere\PublicApiClient\Campaigns\Entities\LandingPage;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

class LandingPageFooter extends AbstractEntity
{
    public const COLUMN_BACKGROUND_COLOR = 'backgroundColor';
    public const COLUMN_BUTTON_TEXT = 'buttonText';
    public const COLUMN_BUTTON_URL = 'buttonUrl';
    public const COLUMN_FEATURES = 'features';
    public const COLUMN_TEXT_COLOR = 'textColor';
    public const COLUMN_TITLE = 'title';

    public const DEFAULT_VALUE_BACKGROUND_COLOR = '';
    public const DEFAULT_VALUE_BUTTON_TEXT = '';
    public const DEFAULT_VALUE_BUTTON_URL = '';
    public const DEFAULT_VALUE_TEXT_COLOR = '#FFF';
    public const DEFAULT_VALUE_TITLE = '';

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_BACKGROUND_COLOR)]
    protected string $backgroundColor = self::DEFAULT_VALUE_BACKGROUND_COLOR;

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
     * @var LandingPageFeature[]
     */
    #[Property(name: self::COLUMN_FEATURES, type: LandingPageFeature::class, isArray: true)]
    protected array $features = [];

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_TEXT_COLOR)]
    protected string $textColor = self::DEFAULT_VALUE_TEXT_COLOR;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_TITLE)]
    protected string $title = self::DEFAULT_VALUE_TITLE;

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
    public function getBackgroundColor(): string
    {
        return $this->backgroundColor;
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

    /**
     * @return string
     */
    public function getTextColor(): string
    {
        return $this->textColor;
    }

    /**
     * @return LandingPageFeature[]
     */
    public function getFeatures(): array
    {
        return $this->features;
    }
}
