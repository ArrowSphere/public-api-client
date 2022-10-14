<?php

namespace ArrowSphere\PublicApiClient\Campaigns\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

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
    private $backgroundImageUuid;

    /**
     * @var string|null
     */
    private $backgroundColor;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $buttonPlacement;

    /**
     * @var string|null
     */
    private $buttonText;

    /**
     * @var string|null
     */
    private $text;

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

        $this->backgroundImageUuid = $data[self::COLUMN_BACKGROUND_IMAGE_UUID] ?? self::DEFAULT_VALUE_BACKGROUND_IMAGE_UUID;
        $this->backgroundColor = $data[self::COLUMN_BACKGROUND_COLOR] ?? self::DEFAULT_VALUE_BACKGROUND_COLOR;
        $this->type = $data[self::COLUMN_TYPE] ?? self::DEFAULT_VALUE_TYPE;
        $this->buttonPlacement = $data[self::COLUMN_BUTTON_PLACEMENT] ?? self::DEFAULT_VALUE_BUTTON_PLACEMENT;
        $this->buttonText = $data[self::COLUMN_BUTTON_TEXT] ?? self::DEFAULT_VALUE_BUTTON_TEXT;
        $this->text = $data[self::COLUMN_TEXT] ?? self::DEFAULT_VALUE_TEXT;
        $this->textColor = $data[self::COLUMN_TEXT_COLOR] ?? self::DEFAULT_VALUE_TEXT_COLOR;
    }

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

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_BACKGROUND_IMAGE_UUID => $this->getBackgroundImageUuid(),
            self::COLUMN_BACKGROUND_COLOR      => $this->getBackgroundColor(),
            self::COLUMN_TYPE                  => $this->getType(),
            self::COLUMN_BUTTON_PLACEMENT      => $this->getButtonPlacement(),
            self::COLUMN_BUTTON_TEXT           => $this->getButtonText(),
            self::COLUMN_TEXT                  => $this->getText(),
            self::COLUMN_TEXT_COLOR            => $this->getTextColor(),
        ];
    }
}
