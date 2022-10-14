<?php

namespace ArrowSphere\PublicApiClient\Campaigns\Entities\LandingPage;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

class LandingPageBody extends AbstractEntity
{
    public const COLUMN_BACKGROUND_IMAGE_UUID = 'backgroundImageUuid';
    public const COLUMN_TYPE = 'type';
    public const COLUMN_TITLE = 'title';
    public const COLUMN_DESCRIPTION = 'description';
    public const COLUMN_VIDEO_URL = 'videoUrl';
    public const COLUMN_BUTTON_TEXT = 'buttonText';
    public const COLUMN_CONTACT_EMAIL = 'contactEmail';

    public const DEFAULT_VALUE_BACKGROUND_IMAGE_UUID = '';
    public const DEFAULT_VALUE_TYPE = '';
    public const DEFAULT_VALUE_TITLE = '';
    public const DEFAULT_VALUE_DESCRIPTION = '';
    public const DEFAULT_VALUE_VIDEO_URL = null;
    public const DEFAULT_VALUE_BUTTON_TEXT = null;
    public const DEFAULT_VALUE_CONTACT_EMAIL = null;

    /**
     * @var string
     */
    private $backgroundImageUuid;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string|null
     */
    private $videoUrl;

    /**
     * @var string|null
     */
    private $buttonText;

    /**
     * @var string|null
     */
    private $contactEmail;

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
        $this->type = $data[self::COLUMN_TYPE] ?? self::DEFAULT_VALUE_TYPE;
        $this->title = $data[self::COLUMN_TITLE] ?? self::DEFAULT_VALUE_TITLE;
        $this->description = $data[self::COLUMN_DESCRIPTION] ?? self::DEFAULT_VALUE_DESCRIPTION;
        $this->videoUrl = $data[self::COLUMN_VIDEO_URL] ?? self::DEFAULT_VALUE_VIDEO_URL;
        $this->buttonText = $data[self::COLUMN_BUTTON_TEXT] ?? self::DEFAULT_VALUE_BUTTON_TEXT;
        $this->contactEmail = $data[self::COLUMN_CONTACT_EMAIL] ?? self::DEFAULT_VALUE_CONTACT_EMAIL;
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
    public function getType(): string
    {
        return $this->type;
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
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string|null
     */
    public function getVideoUrl(): ?string
    {
        return $this->videoUrl;
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
    public function getContactEmail(): ?string
    {
        return $this->contactEmail;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_BACKGROUND_IMAGE_UUID => $this->getBackgroundImageUuid(),
            self::COLUMN_TYPE                  => $this->getType(),
            self::COLUMN_TITLE                 => $this->getTitle(),
            self::COLUMN_DESCRIPTION           => $this->getDescription(),
            self::COLUMN_VIDEO_URL             => $this->getVideoUrl(),
            self::COLUMN_BUTTON_TEXT           => $this->getButtonText(),
            self::COLUMN_CONTACT_EMAIL         => $this->getContactEmail(),
        ];
    }
}
