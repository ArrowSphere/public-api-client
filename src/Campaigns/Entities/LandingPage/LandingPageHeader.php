<?php

namespace ArrowSphere\PublicApiClient\Campaigns\Entities\LandingPage;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

class LandingPageHeader extends AbstractEntity
{
    public const COLUMN_BACKGROUNDCOLOR = 'backgroundColor';
    public const COLUMN_BACKGROUNDIMAGEUUID = 'backgroundImageUuid';
    public const COLUMN_BASELINE = 'baseline';
    public const COLUMN_TEXTCOLOR = 'textColor';
    public const COLUMN_TITLE = 'title';
    public const COLUMN_VENDORLOGOUUID = 'vendorLogoUuid';

    public const DEFAULT_VALUE_BACKGROUNDCOLOR = null;
    public const DEFAULT_VALUE_BACKGROUNDIMAGEUUID = '';
    public const DEFAULT_VALUE_BASELINE = '';
    public const DEFAULT_VALUE_TEXTCOLOR = null;
    public const DEFAULT_VALUE_TITLE = '';
    public const DEFAULT_VALUE_VENDORLOGOUUID = '';

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

        $this->backgroundImageUuid = $data[self::COLUMN_BACKGROUNDIMAGEUUID] ?? self::DEFAULT_VALUE_BACKGROUNDIMAGEUUID;
        $this->vendorLogoUuid = $data[self::COLUMN_VENDORLOGOUUID] ?? self::DEFAULT_VALUE_VENDORLOGOUUID;
        $this->title = $data[self::COLUMN_TITLE] ?? self::DEFAULT_VALUE_TITLE;
        $this->backgroundColor = $data[self::COLUMN_BACKGROUNDCOLOR] ?? self::DEFAULT_VALUE_BACKGROUNDCOLOR;
        $this->baseline = $data[self::COLUMN_BASELINE] ?? self::DEFAULT_VALUE_BASELINE;
        $this->textColor = $data[self::COLUMN_TEXTCOLOR] ?? self::DEFAULT_VALUE_TEXTCOLOR;
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
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_BACKGROUNDIMAGEUUID => $this->getBackgroundImageUuid(),
            self::COLUMN_VENDORLOGOUUID      => $this->getVendorLogoUuid(),
            self::COLUMN_TITLE               => $this->getTitle(),
            self::COLUMN_BACKGROUNDCOLOR     => $this->getBackgroundColor(),
            self::COLUMN_BASELINE            => $this->getBaseline(),
            self::COLUMN_TEXTCOLOR           => $this->getTextColor(),
        ];
    }
}
