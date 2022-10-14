<?php

namespace ArrowSphere\PublicApiClient\Campaigns\Entities\LandingPage;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

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
    private $title;

    /**
     * @var string
     */
    private $description;

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
    private $imageUuid;

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

        $this->title = $data[self::COLUMN_TITLE] ?? self::DEFAULT_VALUE_TITLE;
        $this->description = $data[self::COLUMN_DESCRIPTION] ?? self::DEFAULT_VALUE_DESCRIPTION;
        $this->buttonText = $data[self::COLUMN_BUTTON_TEXT] ?? self::DEFAULT_VALUE_BUTTON_TEXT;
        $this->buttonUrl = $data[self::COLUMN_BUTTON_URL] ?? self::DEFAULT_VALUE_BUTTON_URL;
        $this->imageUuid = $data[self::COLUMN_IMAGE_UUID] ?? self::DEFAULT_VALUE_IMAGE_UUID;
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

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_TITLE       => $this->getTitle(),
            self::COLUMN_DESCRIPTION => $this->getDescription(),
            self::COLUMN_ICON        => $this->getIcon(),
            self::COLUMN_SIZE        => $this->getSize(),
            self::COLUMN_BUTTON_TEXT => $this->getButtonText(),
            self::COLUMN_BUTTON_URL  => $this->getButtonUrl(),
            self::COLUMN_IMAGE_UUID  => $this->getImageUuid(),
        ];
    }
}
