<?php

namespace ArrowSphere\PublicApiClient\Campaigns\Entities\LandingPage;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

class LandingPageFooter extends AbstractEntity
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
    private $title;

    /**
     * @var string
     */
    private $backgroundColor;

    /**
     * @var string
     */
    private $buttonText;

    /**
     * @var string
     */
    private $buttonUrl;

    /**
     * @var string
     */
    private $textColor;

    /**
     * @var LandingPageFeature
     */
    private $feature;

    /**
     * @var LandingPageMarketingFeature
     */
    private $marketingFeature;

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

        $this->backgroundColor = $data[self::COLUMN_BACKGROUND_COLOR] ?? self::DEFAULT_VALUE_BACKGROUND_COLOR;
        $this->buttonText = $data[self::COLUMN_BUTTON_TEXT] ?? self::DEFAULT_VALUE_BUTTON_TEXT;
        $this->buttonUrl = $data[self::COLUMN_BUTTON_URL] ?? self::DEFAULT_VALUE_BUTTON_URL;
        $this->feature = new LandingPageFeature($data[self::COLUMN_FEATURE] ?? []);
        $this->marketingFeature = new LandingPageMarketingFeature($data[self::COLUMN_MARKETING_FEATURE] ?? []);
        $this->textColor = $data[self::COLUMN_TEXT_COLOR] ?? self::DEFAULT_VALUE_TEXT_COLOR;
        $this->title = $data[self::COLUMN_TITLE] ?? self::DEFAULT_VALUE_TITLE;
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
     * @return LandingPageFeature
     */
    public function getFeature(): LandingPageFeature
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

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_BACKGROUND_COLOR   => $this->getBackgroundColor(),
            self::COLUMN_BUTTON_TEXT        => $this->getButtonText(),
            self::COLUMN_BUTTON_URL         => $this->getButtonUrl(),
            self::COLUMN_FEATURE            => $this->getFeature(),
            self::COLUMN_MARKETING_FEATURE  => $this->getMarketingFeature(),
            self::COLUMN_TEXT_COLOR         => $this->getTextColor(),
            self::COLUMN_TITLE              => $this->getTitle(),
        ];
    }
}
