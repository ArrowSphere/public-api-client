<?php

namespace ArrowSphere\PublicApiClient\Campaigns\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

class Banner extends AbstractEntity
{
    public const COLUMN_BACKGROUNDIMAGEUUID = 'backgroundImageUuid';
    public const COLUMN_BACKGROUNDCOLOR = 'backgroundColor';
    public const COLUMN_TYPE = 'type';
    public const COLUMN_BUTTONPLACEMENT = 'buttonPlacement';
    public const COLUMN_BUTTONTEXT = 'buttonText';
    public const COLUMN_TEXT = 'text';
    public const COLUMN_TEXTCOLOR = 'textColor';

    public const DEFAULT_VALUE_BACKGROUNDIMAGEUUID = '';
    public const DEFAULT_VALUE_BACKGROUNDCOLOR = null;
    public const DEFAULT_VALUE_TYPE = 'BACKGROUND_COLOR';
    public const DEFAULT_VALUE_BUTTONPLACEMENT = 'RIGHT';
    public const DEFAULT_VALUE_BUTTONTEXT = null;
    public const DEFAULT_VALUE_TEXT = null;
    public const DEFAULT_VALUE_TEXTCOLOR = null;

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

        $this->backgroundImageUuid = $data[self::COLUMN_BACKGROUNDIMAGEUUID] ?? self::DEFAULT_VALUE_BACKGROUNDIMAGEUUID;
        $this->backgroundColor = $data[self::COLUMN_BACKGROUNDCOLOR] ?? self::DEFAULT_VALUE_BACKGROUNDCOLOR;
        $this->type = $data[self::COLUMN_TYPE] ?? self::DEFAULT_VALUE_TYPE;
        $this->buttonPlacement = $data[self::COLUMN_BUTTONPLACEMENT] ?? self::DEFAULT_VALUE_BUTTONPLACEMENT;
        $this->buttonText = $data[self::COLUMN_BUTTONTEXT] ?? self::DEFAULT_VALUE_BUTTONTEXT;
        $this->text = $data[self::COLUMN_TEXT] ?? self::DEFAULT_VALUE_TEXT;
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
            self::COLUMN_BACKGROUNDIMAGEUUID => $this->getBackgroundImageUuid(),
            self::COLUMN_BACKGROUNDCOLOR     => $this->getBackgroundColor(),
            self::COLUMN_TYPE                => $this->getType(),
            self::COLUMN_BUTTONPLACEMENT     => $this->getButtonPlacement(),
            self::COLUMN_BUTTONTEXT          => $this->getButtonText(),
            self::COLUMN_TEXT                => $this->getText(),
            self::COLUMN_TEXTCOLOR           => $this->getTextColor(),
        ];
    }
}
