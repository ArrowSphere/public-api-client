<?php

namespace ArrowSphere\PublicApiClient\Campaigns\Entities\LandingPage;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

class LandingPageFooter extends AbstractEntity
{
    public const COLUMN_BACKGROUNDCOLOR = 'backgroundColor';
    public const COLUMN_BUTTONTEXT = 'buttonText';
    public const COLUMN_BUTTONURL = 'buttonUrl';
    public const COLUMN_FEATURES = 'features';
    public const COLUMN_TEXTCOLOR = 'textColor';
    public const COLUMN_TITLE = 'title';

    public const DEFAULT_VALUE_BACKGROUNDCOLOR = '';
    public const DEFAULT_VALUE_BUTTONTEXT = '';
    public const DEFAULT_VALUE_BUTTONURL = '';
    public const DEFAULT_VALUE_TEXTCOLOR = '#FFF';
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
     * @throws EntityValidationException
     * @throws \ReflectionException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->backgroundColor = $data[self::COLUMN_BACKGROUNDCOLOR] ?? self::DEFAULT_VALUE_BACKGROUNDCOLOR;
        $this->buttonText = $data[self::COLUMN_BUTTONTEXT] ?? self::DEFAULT_VALUE_BUTTONTEXT;
        $this->buttonUrl = $data[self::COLUMN_BUTTONURL] ?? self::DEFAULT_VALUE_BUTTONURL;
        $this->features = array_map(
            static function (array $features) {
                return new LandingPageFeature($features);
            },
            $data[self::COLUMN_FEATURES] ?? []
        );
        $this->textColor = $data[self::COLUMN_TEXTCOLOR] ?? self::DEFAULT_VALUE_TEXTCOLOR;
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
            self::COLUMN_BACKGROUNDCOLOR => $this->getBackgroundColor(),
            self::COLUMN_BUTTONTEXT      => $this->getButtonText(),
            self::COLUMN_BUTTONURL       => $this->getButtonUrl(),
            self::COLUMN_FEATURES        => $this->getFeatures(),
            self::COLUMN_TEXTCOLOR       => $this->getTextColor(),
            self::COLUMN_TITLE           => $this->getTitle(),
        ];
    }
}
