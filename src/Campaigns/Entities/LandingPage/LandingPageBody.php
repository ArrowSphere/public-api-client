<?php

namespace ArrowSphere\PublicApiClient\Campaigns\Entities\LandingPage;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

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
    #[Property(name: self::COLUMN_BACKGROUND_IMAGE_UUID)]
    protected string $backgroundImageUuid = self::DEFAULT_VALUE_BACKGROUND_IMAGE_UUID;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_TYPE)]
    protected string $type = self::DEFAULT_VALUE_TYPE;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_TITLE)]
    protected string $title = self::DEFAULT_VALUE_TITLE;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_DESCRIPTION)]
    protected string $description = self::DEFAULT_VALUE_DESCRIPTION;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_VIDEO_URL, serializeNull: true)]
    protected ?string $videoUrl = self::DEFAULT_VALUE_VIDEO_URL;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_BUTTON_TEXT, serializeNull: true)]
    protected ?string $buttonText = self::DEFAULT_VALUE_BUTTON_TEXT;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_CONTACT_EMAIL, serializeNull: true)]
    protected ?string $contactEmail = self::DEFAULT_VALUE_CONTACT_EMAIL;

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
}
