<?php

namespace ArrowSphere\PublicApiClient\Campaigns\Entities\LandingPage;

use ArrowSphere\PublicApiClient\AbstractEntity;

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
     * @var LandingPageFeature[]
     */
    private $features;

    /**
     * Statement constructor.
     *
     * @param array $data
     *
     * @throws \ReflectionException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->backgroundColor = $data[self::COLUMN_BACKGROUND_COLOR] ?? self::DEFAULT_VALUE_BACKGROUND_COLOR;
        $this->buttonText = $data[self::COLUMN_BUTTON_TEXT] ?? self::DEFAULT_VALUE_BUTTON_TEXT;
        $this->buttonUrl = $data[self::COLUMN_BUTTON_URL] ?? self::DEFAULT_VALUE_BUTTON_URL;
        $this->features = array_map(
            static function (array $features) {
                return new LandingPageFeature($features);
            },
            $data[self::COLUMN_FEATURES] ?? []
        );
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
     * @return LandingPageFeature[]
     */
    public function getFeatures(): array
    {
        return $this->features;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_BACKGROUND_COLOR => $this->getBackgroundColor(),
            self::COLUMN_BUTTON_TEXT      => $this->getButtonText(),
            self::COLUMN_BUTTON_URL       => $this->getButtonUrl(),
            self::COLUMN_FEATURES         => $this->getFeatures(),
            self::COLUMN_TEXT_COLOR       => $this->getTextColor(),
            self::COLUMN_TITLE            => $this->getTitle(),
        ];
    }
}
