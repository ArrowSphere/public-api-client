<?php

namespace ArrowSphere\PublicApiClient\Campaigns\Entities\LandingPage;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

class LandingPageMarketingFeatureItem extends AbstractEntity
{
    public const COLUMN_TITLE = 'title';
    public const COLUMN_DESCRIPTION = 'description';
    public const COLUMN_BUTTON_TEXT = 'buttonText';
    public const COLUMN_BUTTON_URL = 'buttonUrl';
    public const COLUMN_IMAGE_UUID = 'imageUuid';

    public const DEFAULT_VALUE_TITLE = '';
    public const DEFAULT_VALUE_DESCRIPTION = '';
    public const DEFAULT_VALUE_BUTTON_TEXT = '';
    public const DEFAULT_VALUE_BUTTON_URL = '';
    public const DEFAULT_VALUE_IMAGE_UUID = '';

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
     * @var string
     */
    #[Property(name: self::COLUMN_BUTTON_TEXT)]
    protected string $buttonText = self::DEFAULT_VALUE_BUTTON_TEXT;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_BUTTON_URL)]
    protected string $buttonUrl = self::DEFAULT_VALUE_BUTTON_URL;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_IMAGE_UUID)]
    protected string $imageUuid = self::DEFAULT_VALUE_IMAGE_UUID;

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
    public function getImageUuid(): string
    {
        return $this->imageUuid;
    }
}
