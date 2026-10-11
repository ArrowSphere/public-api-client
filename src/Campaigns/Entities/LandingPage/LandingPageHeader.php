<?php

namespace ArrowSphere\PublicApiClient\Campaigns\Entities\LandingPage;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

class LandingPageHeader extends AbstractEntity
{
    public const COLUMN_BACKGROUND_COLOR = 'backgroundColor';
    public const COLUMN_BACKGROUND_IMAGE_UUID = 'backgroundImageUuid';
    public const COLUMN_BASELINE = 'baseline';
    public const COLUMN_CIRCLE_COLOR = 'circleColor';
    public const COLUMN_TEXT_COLOR = 'textColor';
    public const COLUMN_TITLE = 'title';
    public const COLUMN_VENDOR_LOGO_UUID = 'vendorLogoUuid';

    public const DEFAULT_VALUE_BACKGROUND_COLOR = null;
    public const DEFAULT_VALUE_BACKGROUND_IMAGE_UUID = '';
    public const DEFAULT_VALUE_CIRCLE_COLOR = null;
    public const DEFAULT_VALUE_BASELINE = '';
    public const DEFAULT_VALUE_TEXT_COLOR = null;
    public const DEFAULT_VALUE_TITLE = '';
    public const DEFAULT_VALUE_VENDOR_LOGO_UUID = '';

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_BACKGROUND_IMAGE_UUID)]
    protected string $backgroundImageUuid = self::DEFAULT_VALUE_BACKGROUND_IMAGE_UUID;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_VENDOR_LOGO_UUID)]
    protected string $vendorLogoUuid = self::DEFAULT_VALUE_VENDOR_LOGO_UUID;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_TITLE)]
    protected string $title = self::DEFAULT_VALUE_TITLE;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_BACKGROUND_COLOR, serializeNull: true)]
    protected ?string $backgroundColor = self::DEFAULT_VALUE_BACKGROUND_COLOR;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_BASELINE)]
    protected string $baseline = self::DEFAULT_VALUE_BASELINE;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_TEXT_COLOR, serializeNull: true)]
    protected ?string $textColor = self::DEFAULT_VALUE_TEXT_COLOR;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_CIRCLE_COLOR, serializeNull: true)]
    protected ?string $circleColor = self::DEFAULT_VALUE_CIRCLE_COLOR;

    /**
     * @return string
     */
    public function getBackgroundImageUuid(): string
    {
        return $this->backgroundImageUuid;
    }

    /**
     * @return string
     */
    public function getVendorLogoUuid(): string
    {
        return $this->vendorLogoUuid;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string|null
     */
    public function getBackgroundColor(): ?string
    {
        return $this->backgroundColor;
    }

    /**
     * @return string
     */
    public function getBaseline(): string
    {
        return $this->baseline;
    }

    /**
     * @return string|null
     */
    public function getTextColor(): ?string
    {
        return $this->textColor;
    }

    /**
     * @return string|null
     */
    public function getCircleColor(): ?string
    {
        return $this->circleColor;
    }
}
