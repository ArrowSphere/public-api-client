<?php

namespace ArrowSphere\PublicApiClient\Campaigns\Entities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

class Banner extends AbstractEntity
{
    public const COLUMN_BACKGROUND_IMAGE_UUID = 'backgroundImageUuid';
    public const COLUMN_BACKGROUND_COLOR = 'backgroundColor';
    public const COLUMN_TYPE = 'type';
    public const COLUMN_BUTTON_PLACEMENT = 'buttonPlacement';
    public const COLUMN_BUTTON_TEXT = 'buttonText';
    public const COLUMN_TEXT = 'text';
    public const COLUMN_TEXT_COLOR = 'textColor';

    public const DEFAULT_VALUE_BACKGROUND_IMAGE_UUID = '';
    public const DEFAULT_VALUE_BACKGROUND_COLOR = null;
    public const DEFAULT_VALUE_TYPE = 'BACKGROUND_COLOR';
    public const DEFAULT_VALUE_BUTTON_PLACEMENT = 'RIGHT';
    public const DEFAULT_VALUE_BUTTON_TEXT = null;
    public const DEFAULT_VALUE_TEXT = null;
    public const DEFAULT_VALUE_TEXT_COLOR = null;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_BACKGROUND_IMAGE_UUID)]
    protected string $backgroundImageUuid = self::DEFAULT_VALUE_BACKGROUND_IMAGE_UUID;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_BACKGROUND_COLOR, serializeNull: true)]
    protected ?string $backgroundColor = self::DEFAULT_VALUE_BACKGROUND_COLOR;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_TYPE)]
    protected string $type = self::DEFAULT_VALUE_TYPE;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_BUTTON_PLACEMENT)]
    protected string $buttonPlacement = self::DEFAULT_VALUE_BUTTON_PLACEMENT;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_BUTTON_TEXT, serializeNull: true)]
    protected ?string $buttonText = self::DEFAULT_VALUE_BUTTON_TEXT;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_TEXT, serializeNull: true)]
    protected ?string $text = self::DEFAULT_VALUE_TEXT;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_TEXT_COLOR, serializeNull: true)]
    protected ?string $textColor = self::DEFAULT_VALUE_TEXT_COLOR;

    /**
     * @return string
     */
    public function getBackgroundImageUuid(): string
    {
        return $this->backgroundImageUuid;
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
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getButtonPlacement(): string
    {
        return $this->buttonPlacement;
    }

    /**
     * @return string|null
     */
    public function getButtonText(): ?string
    {
        return $this->buttonText;
    }

    /**
     * @return string|null
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * @return string|null
     */
    public function getTextColor(): ?string
    {
        return $this->textColor;
    }
}
