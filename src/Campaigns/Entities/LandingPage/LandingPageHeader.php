<?php

namespace ArrowSphere\PublicApiClient\Campaigns\Entities\LandingPage;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

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
    private $backgroundImageUuid;

    /**
     * @var string
     */
    private $vendorLogoUuid;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string|null
     */
    private $backgroundColor;

    /**
     * @var string
     */
    private $baseline;

    /**
     * @var string|null
     */
    private $textColor;

    /**
     * @var string|null
     */
    private $circleColor;

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

        $this->backgroundImageUuid = $data[self::COLUMN_BACKGROUND_IMAGE_UUID] ?? self::DEFAULT_VALUE_BACKGROUND_IMAGE_UUID;
        $this->vendorLogoUuid = $data[self::COLUMN_VENDOR_LOGO_UUID] ?? self::DEFAULT_VALUE_VENDOR_LOGO_UUID;
        $this->title = $data[self::COLUMN_TITLE] ?? self::DEFAULT_VALUE_TITLE;
        $this->backgroundColor = $data[self::COLUMN_BACKGROUND_COLOR] ?? self::DEFAULT_VALUE_BACKGROUND_COLOR;
        $this->baseline = $data[self::COLUMN_BASELINE] ?? self::DEFAULT_VALUE_BASELINE;
        $this->textColor = $data[self::COLUMN_TEXT_COLOR] ?? self::DEFAULT_VALUE_TEXT_COLOR;
        $this->circleColor = $data[self::COLUMN_CIRCLE_COLOR] ?? self::DEFAULT_VALUE_CIRCLE_COLOR;
    }

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

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_BACKGROUND_IMAGE_UUID => $this->getBackgroundImageUuid(),
            self::COLUMN_VENDOR_LOGO_UUID      => $this->getVendorLogoUuid(),
            self::COLUMN_TITLE                 => $this->getTitle(),
            self::COLUMN_BACKGROUND_COLOR      => $this->getBackgroundColor(),
            self::COLUMN_BASELINE              => $this->getBaseline(),
            self::COLUMN_TEXT_COLOR            => $this->getTextColor(),
            self::COLUMN_CIRCLE_COLOR          => $this->getCircleColor(),
        ];
    }
}
