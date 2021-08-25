<?php

namespace ArrowSphere\PublicApiClient\Campaigns\Entities\LandingPage;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

class LandingPageFeature extends AbstractEntity
{
    public const COLUMN_DESCRIPTION = 'description';
    public const COLUMN_ICON = 'icon';
    public const COLUMN_SIZE = 'size';
    public const COLUMN_TITLE = 'title';

    public const DEFAULT_VALUE_DESCRIPTION = '';
    public const DEFAULT_VALUE_ICON = '';
    public const DEFAULT_VALUE_SIZE = 4;
    public const DEFAULT_VALUE_TITLE = '';

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
    private $icon;

    /**
     * @var int
     */
    private $size;

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
        $this->icon = $data[self::COLUMN_ICON] ?? self::DEFAULT_VALUE_ICON;
        $this->size = $data[self::COLUMN_SIZE] ?? self::DEFAULT_VALUE_SIZE;
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
    public function getIcon(): string
    {
        return $this->icon;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
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
        ];
    }
}
