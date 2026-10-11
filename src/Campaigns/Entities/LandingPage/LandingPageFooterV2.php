<?php

namespace ArrowSphere\PublicApiClient\Campaigns\Entities\LandingPage;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Exception\EntitiesException;
use ArrowSphere\PublicApiClient\Entities\Property;

class LandingPageFooterV2 extends AbstractEntity
{
    public const COLUMN_BACKGROUND_COLOR = 'backgroundColor';
    public const COLUMN_BUTTON_TEXT = 'buttonText';
    public const COLUMN_BUTTON_URL = 'buttonUrl';
    public const COLUMN_FEATURE = 'feature';
    public const COLUMN_MARKETING_FEATURE = 'marketingFeature';
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
     * @var LandingPageFeatureV2
     */
    #[Property(name: self::COLUMN_FEATURE, type: LandingPageFeatureV2::class, required: true)]
    protected LandingPageFeatureV2 $feature;

    /**
     * @var LandingPageMarketingFeature
     */
    #[Property(name: self::COLUMN_MARKETING_FEATURE, type: LandingPageMarketingFeature::class, required: true)]
    protected LandingPageMarketingFeature $marketingFeature;

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
     * LandingPageFooterV2 constructor.
     *
     * @param array $data
     *
     * @throws EntitiesException
     */
    public function __construct(array $data)
    {
        // A missing or empty feature gets an instance with its default values, as an empty array would be considered as missing
        if (empty($data[self::COLUMN_FEATURE])) {
            $data[self::COLUMN_FEATURE] = new LandingPageFeatureV2([]);
        }

        if (empty($data[self::COLUMN_MARKETING_FEATURE])) {
            $data[self::COLUMN_MARKETING_FEATURE] = new LandingPageMarketingFeature([]);
        }

        parent::__construct($data);
    }

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
     * @return LandingPageFeatureV2
     */
    public function getFeature(): LandingPageFeatureV2
    {
        return $this->feature;
    }

    /**
     * @return LandingPageMarketingFeature
     */
    public function getMarketingFeature(): LandingPageMarketingFeature
    {
        return $this->marketingFeature;
    }
}
